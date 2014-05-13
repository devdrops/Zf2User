<?php

namespace Zf2User\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zf2Base\Mail\Mail;
use Zf2Base\Service\AbstractService;
use Zf2Base\Upload\AbstractUpload;

class User extends AbstractService
{

    protected $transport;
    protected $view;
    protected $image_config;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        parent::__construct($em);

        $this->entity = "Zf2User\Entity\User";
        $this->transport = $transport;
        $this->view = $view;
        $this->image_config = 'directory' => DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR;
    }

    public function persist(array $data, $id = null)
    {
        $foto = $data['user']['perfil']['foto'];
        unset($data['user']['perfil']['foto']);
        $data['user']['papel'] = $this->em->getReference("Zf2Acl\Entity\Papel", $data['user']['papel']);
        $data['user']['perfil']['cidade'] = $this->em->getReference("Zf2Base\Entity\Cidade", $data['user']['perfil']['cidade']);

        if(strlen($data['user']['empresa']) > 0){
            $data['user']['empresa'] = $this->em->getReference("DftBusiness\Entity\Empresa", $data['user']['empresa']);
        }else{
            $data['user']['empresa'] = null;
        }

        if (!is_null($id)) {
            $entity_user = $this->em->getReference($this->entity, $id);
            if(strlen($data['user']['senha']) == 0){
               unset($data['user']['senha']);
            }
            $hydrator = new Hydrator\ClassMethods();
            $entity_perfil = $entity_user->getPerfil();
            $hydrator->hydrate($data['user']['perfil'],$entity_perfil);
            $data['user']['perfil'] = $entity_perfil;

            $hydrator->hydrate($data['user'],$entity_user);

        } else {
            $entity_perfil = new \Zf2User\Entity\Perfil($data['user']['perfil']);
            $data['user']['perfil']  =  $entity_perfil;

            /* instantiating new entity user */
            $entity_user = new $this->entity($data['user']);
        }

        if(is_array($foto)){
             $image = $this->upload($foto);
             if($image){
                $old_image = $entity_perfil->getFoto();
                if (!empty($old_image)) {
                    unlink(BASEDIRECTORY.DIRECTORY_SEPARATOR.$this->image_config['directory'].DIRECTORY_SEPARATOR.$old_image);
                    unlink(BASEDIRECTORY.DIRECTORY_SEPARATOR.$this->image_config['directory'].DIRECTORY_SEPARATOR.'medio_'.$old_image);
                    unlink(BASEDIRECTORY.DIRECTORY_SEPARATOR.$this->image_config['directory'].DIRECTORY_SEPARATOR.'thumb_'.$old_image);
                }
                $entity_perfil->setFoto($image);
            }
        }

        /*set perfil in user */
        $entity_perfil->setUsuario($entity_user);

        /* save perfil */
        $this->em->persist($entity_perfil);

        /*save perfil */
        $this->em->persist($entity_user);

        $this->em->flush();

        return $entity_user;

    }


    public function upload(array $files){
        $upload = new AbstractUpload($files);
        $upload->addOptions(array(
                'name' => $upload->autoRename(),
                'directory' => $this->image_config['directory'],
                'type' => 'one', // one, array, multiple
                'thumb' => array(
                    array(
                        'name' => 'medio_',
                        'options' => array(
                            'widht' => 360,
                            'height' => 360
                        )
                    ),
                    array(
                        'name' => 'thumb_',
                        'options' => array(
                            'widht' => 250,
                            'height' => 250
                        )
                    )
                )
            ));
        return $upload->loadImages();
    }

    public function ativacao($user_id){
        $entity_user = $this->em->getReference($this->entity, $user_id);
        $situacaoAtual = $entity_user->getSituacao();

        $situacao = ($situacaoAtual) ? 0: 1;
        $entity_user->setSituacao($situacao);
        $this->em->persist($entity_user);
        $this->em->flush();
    }
}
