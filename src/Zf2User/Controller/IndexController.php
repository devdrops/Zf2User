<?php

namespace Zf2User\Controller;

use Zf2Base\Controller\CrudController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

use DoctrineModule\Validator\NoObjectExists;

class IndexController extends CrudController
{
    public function __construct()
    {
        $this->entity = "Zf2User\Entity\User";
        $this->service = "Zf2User\Service\User";
        $this->form = "Zf2User\Form\User";
        $this->controller = "Index";
        $this->route = "user-all/default";
    }

    public function indexAction()
    {
        $usuarioLogado = $this->getEm()->getRepository('Zf2User\Entity\User')->findOneById($this->UserAuthentication()->getIdentity()->getId());
        if($usuarioLogado->getRole()->getName() == 'Developer')
        {
            $list = $this->getEm()
                         ->getRepository($this->entity)
                         ->findAll();
        }else{
            if(!is_null($usuarioLogado->getEmpresa())){
                $list = $this->getEm()
                        ->getRepository($this->entity)->findByEmpresa($usuarioLogado->getEmpresa());
            }
        }

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(20);

        $viewmodel = new ViewModel(array(
            'data'=>$paginator,
            'page'=>$page,
            'flashMessages' => $this->flashMessenger()->getMessages()
        ));

        $layout = $this->layout();
        $layout->setTemplate('layout/ajax-layout');

        return $viewmodel;
    }

    public function registerAction()
    {
        $usuarioLogado = $this->getEm()->getRepository('Zf2User\Entity\User')->findOneById($this->UserAuthentication()->getIdentity()->getId());
        $request = $this->getRequest();

        $id = $this->params()->fromRoute('id',0);

        $form = new $this->form('user', array('id' => $id, 'em' => $this->getEm()));

        if($id){
            $repository = $this->getEm()->getRepository($this->entity);
            $entity = $repository->findOneById($id);
            $populate = $entity->toArray();

            if($entity->getPerfil() && $entity->getPerfil()->getCidade()){
                $populate['user']['perfil'] = $entity->getPerfil()->toArray();
                $populate['user']['perfil']['estado'] = $entity->getPerfil()->getCidade()->getEstado()->getId();
                $populate['user']['perfil']['cidade'] = $entity->getPerfil()->getCidade()->getId();
                $populate['user']['perfil']['cidade_hidden'] = $entity->getPerfil()->getCidade()->getId();
            }

            /*imagem*/
            $populate['user']['perfil']['foto_hidden'] = $this->getPathImage().$entity->getPerfil()->getFoto();

            $form->setData($populate);
        }

        if($request->isPost())
        {
            if($id) {
                $post = $request->getPost()->toArray();
                $post['user']['id'] = $entity->getId();
                $aux = $request->getFiles()->toArray();
                $post['user']['perfil']['foto'] = $aux['user']['perfil']['foto'];

                if(empty($post['user']['senha'])){
                    $form->getInputFilter()->get('user')->get('senha')->setRequired(false);
                    $form->getInputFilter()->get('user')->get('confirmar')->setRequired(false);
                }

                $email_validator = new \DoctrineModule\Validator\UniqueObject(
                        array(
                            'object_repository' => $this->getRepository('\Zf2User\Entity\User'),
                            'object_manager' => $this->getEm(),
                            'fields' => array('email')
                        ));

                $form->getInputFilter()->get('user')->get('email')
                        ->getValidatorChain()
                        ->attach($email_validator);
            } else {
                $email_validator = new \DoctrineModule\Validator\NoObjectExists(
                    array(
                        'object_repository' => $this->getRepository('\Zf2User\Entity\User'),
                        'fields' => array('email')
                    ));

                $form->getInputFilter()->get('user')->get('email')
                        ->getValidatorChain()
                        ->attach($email_validator);

                $post = $request->getPost()->toArray();
                $post['user']['perfil']['cidade_hidden'] = $post['user']['perfil']['cidade'];
                $aux = $request->getFiles();
                $post['user']['perfil']['foto'] = $aux['user']['perfil']['foto'];
            }

            $form->setData($post);
            if($form->isValid())
            {
                $post['user_id'] = $this->UserAuthentication()->getIdentity()->getId();
                $service = $this->getServiceLocator()->get($this->service);
                if($id) {
                    $entity_user = $service->persist($post, $entity->getId());
                } else {
                    $entity_user = $service->persist($post);
                }

                $this->flashMessenger()->addMessage('Salvo com sucesso!');

                if ($usuarioLogado->getPapel()->getNome() == 'Developer') {
                    return $this->redirect()->toUrl($this->Url()->fromRoute('home-dev').'#'.$this->Url()->fromRoute($this->route,array('controller'=>$this->controller)));
                } else {
                    return $this->redirect()->toUrl($this->Url()->fromRoute('home').'#'.$this->Url()->fromRoute($this->route,array('controller'=>$this->controller)));
                }
            }

        }

        return new ViewModel(array(
            'form' => $form,
            'id' => $id
        ));
    }

    public function activateAction()
    {
        $usuarioLogado = $this->getEm()->getRepository('Zf2User\Entity\User')->findOneById($this->UserAuthentication()->getIdentity()->getId());

        $service = $this->getServiceLocator()->get($this->service);
        $service->ativacao($this->params()->fromRoute('id',null));

        if ($usuarioLogado->getPapel()->getNome() == 'Developer') {
            return $this->redirect()->toUrl($this->Url()->fromRoute('home-dev').'#'.$this->Url()->fromRoute($this->route,array('controller'=>$this->controller)));
        } else {
            return $this->redirect()->toUrl($this->Url()->fromRoute('home').'#'.$this->Url()->fromRoute($this->route,array('controller'=>$this->controller)));
        }
    }
}
