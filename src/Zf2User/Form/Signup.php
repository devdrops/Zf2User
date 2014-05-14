<?php

namespace Zf2User\Form;

use Zend\Form\Form;

class Signup extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post')
             ->setInputFilter(new SignupFilter())
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
                'placeholder' => 'Confirmation',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Confirmation:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'terms',
            'options' => array(
                'label' => 'Terms'
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
}
