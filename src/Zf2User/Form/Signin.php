<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zend\Form\Form;

class Signin extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post')
             ->setInputFilter(new SigninFilter())
             ->setAttribute('class', 'form-signin');

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'username',
            'attributes' => array(
                'class' => 'form-control col-xs-12 col-sm-10 col-md-10 col-lg-10',
                'placeholder' => 'Username',
            ),
            'options' => array(
                'label' => 'Username:',
                'label_attributes' => array(
                    'class' => 'control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'password',
            'attributes' => array(
                'class' => 'form-control col-xs-12 col-sm-10 col-md-10 col-lg-10',
                'placeholder' => 'Password',
            ),
            'options' => array(
                'label' => 'Password:',
                'label_attributes' => array(
                    'class' => 'control-label col-xs-12 col-sm-2 col-md-2 col-lg-2 no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'rememberme',
            'options' => array(
                'label' => 'Remember me'
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Autenticar',
                'class' => 'login-action btn btn-primary'
            )
        ));
    }
}
