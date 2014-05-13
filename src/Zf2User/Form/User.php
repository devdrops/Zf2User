<?php

namespace Zf2User\Form;

use Zend\Form\Form;
use Zf2User\Form\UserFieldset;

class User extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('role', 'form');

        $user_fieldset = new UserFieldset('user', $options);
        $this->add($user_fieldset);

        $this->add(array(
            'type'=>'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value'=>'Salvar',
                'class' => 'btn btn-success'
            )
        ));
    }
}
