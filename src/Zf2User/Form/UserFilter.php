<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
    private $em = null;

    public function __construct($options = array())
    {
        $this->em = array_key_exists('em', $options) ? $options['em'] : null ;
        $this->id = array_key_exists('id', $options) ? $options['id'] : null ;

        $validator_email = array(
            'name' => 'DoctrineModule\Validator\NoObjectExists',
            'options' => array(
                'object_repository' => $this->getEm()->getRepository('Zf2User\Entity\User'),
                'fields' => 'email',
                'messages' => array( NoObjectExists::ERROR_OBJECT_FOUND => "Este e-mail já esta em uso." )
            ),
        );
        if ($this->id) {
            $validator_email = array(
                'name' => 'DoctrineModule\Validator\UniqueObject',
                'options' => array(
                    'object_repository' => $this->getEm()->getRepository('Zf2User\Entity\User'),
                    'fields' => 'email',
                    'object_manager' => $this->getEm(),
                    'messages' => array( UniqueObject::ERROR_OBJECT_NOT_UNIQUE => "Este e-mail já esta em uso.", )
                ),
            );
        }

        $this->add(array(
            'name'       => 'email',
            'required'   => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'notEmptyInvalid' => "E-mail inválido.",
                            'isEmpty' => "Por favor digite um e-mail.",
                        )
                    )
                ),
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'messages' => array(
                            'emailAddressInvalid' => "E-mail inválido.",
                            'emailAddressInvalidFormat' => "Formato de e-mail inválido.",
                            'emailAddressInvalidHostname' => "Hostname do e-mail inválida.",
                        )
                    )
                ),
                $validator_email
            ),
        ));

        $validator_username = array(
            'name' => 'DoctrineModule\Validator\NoObjectExists',
            'options' => array(
                'object_repository' => $this->getEm()->getRepository('Zf2User\Entity\User'),
                'fields' => 'username',
                'messages' => array( NoObjectExists::ERROR_OBJECT_FOUND => "Este nome de usuário já esta em uso." )
            ),
        );
        if ($this->id) {
            $validator_username = array(
                'name' => 'DoctrineModule\Validator\UniqueObject',
                'options' => array(
                    'object_repository' => $this->getEm()->getRepository('Zf2User\Entity\User'),
                    'fields' => 'username',
                    'object_manager' => $this->getEm(),
                    'messages' => array( UniqueObject::ERROR_OBJECT_NOT_UNIQUE => "Este nome de usuário já esta em uso.", )
                ),
            );
        }
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
                $validator_username
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
            'name' => 'confirmation',
            'required' => true,
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
                            'isEmpty' => "Por favor digite a senha.",
                        )
                    )
                ),
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password',
                        'messages' => array(
                            'notSame' => "Senha inválido.",
                            'missingToken' => "Por favor digite a senha.",
                        )
                    ),
                ),
            )
        ));

        $this->add(array(
            'name' => 'role',
            'required' => true
        ));
    }
}
