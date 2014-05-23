<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zend\InputFilter\InputFilter;

class SigninFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name'=>'username',
            'required'=>true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'notEmptyInvalid' => "Usuário inválido.",
                            'isEmpty' => "Por favor digite um usuário.",
                        )
                    )
                ),
            )
        ));

        $this->add(array(
            'name'=>'password',
            'required'=>true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'notEmptyInvalid' => "Senha inválido.",
                            'isEmpty' => "Por favor digite uma senha.",
                        )
                    )
                ),
            )
        ));

        $this->add(array(
            'name'=>'rememberme',
            'required'=>false,
        ));
    }
}
