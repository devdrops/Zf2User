<?php

namespace Zf2User\Form;

use Zf2User\Entity\User;
use Zend\Form\Fieldset,
	Zend\InputFilter\InputFilterProviderInterface,
	Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use Zf2User\Form\PerfilFieldset as PerfilFieldset;

class UserFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $em = null;
    private $id = null;
    private $user = null;
	public function __construct($name = null, $options = array())
	{
		parent::__construct($name);
        $this->em = $options['em'];
        $this->id = $options['id'];
        $this->user = $options['user'];
		$this->setHydrator(new ClassMethodsHydrator(false))
			 ->setObject(new User);

        $this->setLabel("Usuario");

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'attributes' => array(
                'class' => 'form-control col-xs-12 email',
                'placeholder' => 'Email',
            ),
            'options' => array(
                'label' => 'Email:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'usuario',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Usuario',
            ),
            'options' => array(
                'label' => 'Usuario:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'senha',
            'attributes' => array(
                'placeholder' => 'Senha',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Senha:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'confirmar',
            'attributes' => array(
                'placeholder' => 'Redigite a senha',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Redigite a senha:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'name' => 'dica_senha',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Dica da senha',
            ),
            'options' => array(
                'label' => 'Dica da senha:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'papel',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'papel_select'
            ),
            'options' => array(
                'label' => 'Papel:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
                'empty_option' => 'Por favor, escolha um papel para o usuario',
                'value_options' => $this->getPapeis()
            ),
        ));

         $this->add(array(
                'name' => 'empresa',
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'attributes' => array(
                    'class' => 'form-control col-xs-12',
                    'id' => 'empresa_select'
                ),
                'options' => array(
                        'label' => "Empresa:",
                        'label_attributes' => array(
                            'class' => 'col-sm-2 control-label no-padding-right'
                        ),
                        'object_manager' => $this->getEm(),
                        'target_class' => 'DftBusiness\Entity\Empresa',
                        'property' => 'nomeFantasia',
                        'empty_option' => 'Por favor, escolha uma empresa para o usuario',
                ),
        ));

        $usuario_fieldset = new PerfilFieldset('perfil', array('id'=> $this->getPerfilId(), 'em' => $this->getEm(),'path' => $options['path']));
        $this->add($usuario_fieldset);
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {
    	return array(
            'email' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo EMAIL não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo EMAIL está errado.',
                            )
                        )
                    )
                )
            ),

            'usuario' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo USUÁRIO não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo USUÁRIO está errado.',
                            )
                        )
                    )
                )
            ),
            'senha' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo SENHA não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo SENHA está errado.',
                            )
                        )
                    )
                )
            ),
            'confirmar' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo CONFIRMAÇÃO DE SENHA não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo CONFIRMAÇÃO DE SENHA está errado.',
                            )
                        )
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'senha',
                            'messages' => array(
                                    \Zend\Validator\Identical::NOT_SAME      => "Os campos CONFIRMAÇÃO DE SENHA deve ser igual ao SENHA.",
                                    \Zend\validator\Identical::MISSING_TOKEN => 'No token was provided to match against',
                            )
                        ),
                    ),
                )
            ),
            'empresa' => array(
                'required' => false
            )
    	);
    }

    public function getPapeis(){
        //return $this->getEm()->getRepository('Zf2Acl\Entity\Papel')->fetchParent();
        return $this->getEm()->getRepository('Zf2Acl\Entity\Papel')->getPapeis($this->usuario);
    }

    public function getRepository($repository){
        return $this->getEm()->getRepository($repository);
    }

    public function getPerfilId(){
        $perfil = $this->getEm()->getRepository('Zf2User\Entity\Perfil')->findOneByUsuario($this->id);
        return ($perfil)? $perfil->getId() : null;
    }

    public function getEm(){
        return $this->em;
    }
}
