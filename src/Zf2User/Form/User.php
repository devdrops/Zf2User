<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zend\Form\Form;
use Zf2User\Form\PerfilFieldset,
    Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zf2User\Entity\User as EntityUser;

class User extends Form
{
    private $em = null;
    private $id = null;

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->em = $options['em'];
        $this->id = $options['id'];

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('role', 'form')
            ->setInputFilter(new UserFilter());

        $this->setHydrator(new ClassMethodsHydrator(false))
             ->setObject(new EntityUser);

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
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
            'name' => 'username',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Username',
            ),
            'options' => array(
                'label' => 'Username:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'password',
            'attributes' => array(
                'placeholder' => 'Password',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Password:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'confirmation',
            'attributes' => array(
                'placeholder' => 'Password Confirm',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Password Confirm:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'password_clue',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Password Clue',
            ),
            'options' => array(
                'label' => 'Password Clue:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

         $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'role',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => "Role:",
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
                'object_manager' => $this->getEm(),
                'target_class' => 'Zf2Acl\Entity\Role',
                'property' => 'name',
                'empty_option' => 'Por favor, escolha um papel para o usuario',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'status',
            'options' => array(
                'label' => 'Status'
            )
        ));

        $usuario_fieldset = new PerfilFieldset('perfil', $options);
        $this->add($usuario_fieldset);

        $this->add(array(
            'type'=>'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value'=>'Salvar',
                'class' => 'btn btn-success'
            )
        ));
    }

    public function getEm(){
        return $this->em;
    }
}
