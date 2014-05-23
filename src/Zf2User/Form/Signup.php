<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zend\Form\Form;

class Signup extends Form
{
    private $em = null;

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->em = $options['em'];

        $this->setAttribute('method', 'post')
             ->setInputFilter(new SignupFilter($options))
             ->setAttribute('class', 'form-signup');

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
                    'class' => 'col-xs-12 control-label no-padding-right'
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
                    'class' => 'col-xs-12 control-label no-padding-right'
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
                    'class' => 'col-xs-12 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'confirmation',
            'attributes' => array(
                'placeholder' => 'Confirmation Password',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Confirmation Password:',
                'label_attributes' => array(
                    'class' => 'col-xs-12 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'terms',
            'options' => array(
                'label' => 'Terms',
                'use_hidden_element' => false
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Register',
                'class' => 'btn btn-primary btn-lg col-xs-12'
            )
        ));
    }

    public function getEm(){
        return $this->em;
    }
}
