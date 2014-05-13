<?php 

namespace Zf2User\Form;

use Zf2User\Entity\Perfil;
use Zend\Form\Fieldset,
	Zend\InputFilter\InputFilterProviderInterface,
	Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PerfilFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $em = null;
    private $id = null;
    private $path = null;
 	public function __construct($name = null, $options = array())
	{
        $this->em = $options['em'];
        $this->id = $options['id'];
        $this->path = $options['path'];
		parent::__construct('perfil');
		$this->setHydrator(new ClassMethodsHydrator(false))
			 ->setObject(new Perfil);
        $this->setLabel('Perfil');

        $this->add(array(
            'name' => 'pessoa',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'value' => $this->getPessoa(),
            ),
            'options' => array(
                'label' => 'Tipo:',
                'label_attributes' => array(
                    'class' => 'radio col-sm-3 control-label no-padding-right',
                ),
                'value_options' => array(
                    '1' => 'Física',
                    '2' => 'Jurídica',
                ),
            ),
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'cpf_cnpj',
            'attributes' => array(
                'class' => 'cpf_cnpj form-control col-xs-12',
                'placeholder' => 'CPF/CNPJ',
            ),
            'options' => array(
                'label' => 'CPF/CNPJ:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'nome',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Nome',
            ),
            'options' => array(
                'label' => 'Nome:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'data_nasc',
            'attributes' => array(
                'class' => 'form-control col-xs-12 data_nasc datepicker',
                'placeholder' => 'Data de Nascimento',
            ),
            'options' => array(
                'label' => 'Data de Nascimento:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right datepicker'
                ),
            ),
        ));



        $this->add(array(
            'name' => 'cep',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12 cep',
                'id' => 'cep',
                'placeholder' => 'Cep',
            ),
            'options' => array(
                'label' => 'Cep:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));


		$this->add(array(
            'name' => 'endereco',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'endereco',
                'placeholder' => 'Endereço',
            ),
            'options' => array(
                'label' => 'Endereço:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));


        $this->add(array(
            'name' => 'numero',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12 number',
                'id' => 'numero',
                'placeholder' => 'Numero',
            ),
            'options' => array(
                'label' => 'Número:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'complemento',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'complemento',
                'placeholder' => 'Complemento',
            ),
            'options' => array(
                'label' => 'Complemento:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'bairro',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'bairro',
                'placeholder' => 'Bairro',
            ),
            'options' => array(
                'label' => 'Bairro:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'telefone',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12 phone',
                'id' => 'telefone',
                'placeholder' => 'Telefone',
            ),
            'options' => array(
                'label' => 'Telefone:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'celular',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12 phone celular',
                'id' => 'celular',
                'placeholder' => 'Celular',
            ),
            'options' => array(
                'label' => 'Celular:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'estado',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'estado',
            ),
            'options' => array(
                'label' => 'Estado:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label'
                ),
                'empty_option' => 'Selecione um estado',
                'value_options' => $this->getEstados()
            ),
        ));

        $this->add(array(
            'name' => 'cidade',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'cidade'
            ),
            'options' => array(
                'label' => 'Cidade:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label'
                ),
                'empty_option' => 'Selecione uma cidade',
                'value_options' => array(),
                'disable_inarray_validator' => true,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'obs',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'obs',
                'placeholder' => 'Observação',
             ),
            'options' => array(
                'label' => 'Observação:',
                'label_attributes' => array(
                    'class' => 'col-sm-3 control-label no-padding-right'
                ),
            ),
        ));



        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'foto_hidden',
            'attributes' => array(
                'id' => 'k13-file-hidden-input',
                'data-title' => $this->getFoto(),
                'data-image' => $this->getPathToImage()
            ),
        ));

        $this->add(array(
            'name' => 'foto',
            'type' => 'Zend\Form\Element\File',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'id-input-file',
            ),
            'options' => array(
                    'label' => 'Foto:',
                    'label_attributes' => array(
                        'class' => 'col-sm-3 control-label no-padding-right'
                    ),
                    'multiple' => false,
                    'id' => 'foto',
                    'disable_inarray_validator' => true,
                )
            )
        );

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'cidade_hidden',
            'attributes' => array(
                'id' => 'cidade_hidden'
            ),
        ));
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'nome' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo NOME não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo NOME está errado.',
                            )
                        )
                    )
                )
            ),
            'pessoa' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name'=> 'Digits',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\Digits::NOT_DIGITS   => "O campo PESSOA deve conter apenas digitos",
                                \Zend\Validator\Digits::STRING_EMPTY => "O campo PESSOA nao pode conter string",
                                \Zend\Validator\Digits::INVALID      => "O campo PESSOA é invalido"
                            )
                        )
                    )
                )

            ),
            'cpf_cnpj' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'regex',
                        'options' => array(
                            'pattern' => '/^[0-9]{0,3}\.[0-9]{0,3}\.[0-9]{0,3}.[0-9]\-[0-9]{0,2}|[0-9]{0,2}\.[0-9]{0,3}\.[0-9]{0,3}\/[0-9]{0,4}\-[0-9]{0,2}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID   => "O valor do campo CPF/CNPJ está incorreto.",
                                \Zend\Validator\Regex::NOT_MATCH => "Os dados de entrada do campo CPF/CNPJ não está no padrão.",
                                \Zend\Validator\Regex::ERROROUS  => "Há um erro no padrão de entrada.",
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 14,
                            'max' => 18,
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID   => "Invalid type given. String expected",
                                \Zend\Validator\StringLength::TOO_SHORT => "O valor do campo CPF/CNPJ deve conter no mínimo %min% caracteres.",
                                \Zend\Validator\StringLength::TOO_LONG  => "O valor do campo CPF/CNPJ deve conter no máximo %max% caracteres.",
                            )
                        )
                    ),
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'O valor do campo CPF/CNPJ não pode ser vazio.',
                                \Zend\Validator\NotEmpty::INVALID => 'O tipo do campo CPF/CNPJ está errado.',
                            )
                        )
                    )
                )
            ),
            'data_nasc' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'd-m-Y',
                            'messages' => array(
                                \Zend\Validator\Date::INVALID        => "Tipo inválido no campo DATA DE NASCIMENTO",
                                \Zend\Validator\Date::INVALID_DATE   => "Tipo inválido no campo DATA DE NASCIMENTO",
                                \Zend\Validator\Date::FALSEFORMAT    => "O campo DATA DE NASCIMENTO não está no formato esperado",
                            )
                        )
                    ),
                )
            ),
            'cep' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'regex',
                        'options' => array(
                            'pattern' => '/^[0-9]{0,5}\-[0-9]{0,3}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID   => "O valor do campo CEP está incorreto.",
                                \Zend\Validator\Regex::NOT_MATCH => "Os dados de entrada do campo CEP não está no padrão",
                                \Zend\Validator\Regex::ERROROUS  => "Há um erro no padrão de entrada.",
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 9,
                            'max' => 9,
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID   => "Invalid type given. String expected",
                                \Zend\Validator\StringLength::TOO_SHORT => "O valor do campo CEP deve conter no mínimo %min% caracteres",
                                \Zend\Validator\StringLength::TOO_LONG  => "O valor do campo CEP deve conter no máximo %max% caracteres",
                            )
                        )
                    )
                )
            ),
            'celular' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'regex',
                        'options' => array('pattern' => '/^\([0-9]{0,2}\)\s[0-9]{0,4}\-[0-9]{0,4}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID   => "O valor do campo CELULAR está incorreto.",
                                \Zend\Validator\Regex::NOT_MATCH => "Os dados de entrada do campo CELULAR não está no padrão",
                                \Zend\Validator\Regex::ERROROUS  => "Há um erro no padrão de entrada.",
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 14,
                            'max' => 15,
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID   => "Invalid type given. String expected",
                                \Zend\Validator\StringLength::TOO_SHORT => "O valor do campo CELULAR deve conter no mínimo %min% caracteres",
                                \Zend\Validator\StringLength::TOO_LONG  => "O valor do campo CELULAR deve conter no máximo %max% caracteres",
                            )
                        )
                    )
                )
            ),
            'telefone' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'regex',
                        'options' => array('pattern' => '/^\([0-9]{0,2}\)\s[0-9]{0,4}\-[0-9]{0,4}/',
                            'messages' => array(
                                \Zend\Validator\Regex::INVALID   => "O valor do campo TELEFONE está incorreto.",
                                \Zend\Validator\Regex::NOT_MATCH => "Os dados de entrada do campo TELEFONE não está no padrão",
                                \Zend\Validator\Regex::ERROROUS  => "Há um erro no padrão de entrada.",
                            )
                        )
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 14,
                            'max' => 15,
                            'messages' => array(
                                \Zend\Validator\StringLength::INVALID   => "Invalid type given. String expected",
                                \Zend\Validator\StringLength::TOO_SHORT => "O valor do campo TELEFONE deve conter no mínimo %min% caracteres",
                                \Zend\Validator\StringLength::TOO_LONG  => "O valor do campo TELEFONE deve conter no máximo %max% caracteres",
                            )
                        )
                    )
                )
            ),
        );
    }

    public function getPathToImage(){
        return $this->getPath().$this->getFoto();
    }

    private function getPath(){
        return $this->path;
    }

    public function getFoto(){
        return (!is_null($this->getPerfil()) && $this->getPerfil()->getFoto())? $this->getPerfil()->getFoto() : '';
    }

    public function getPessoa(){
        return (!is_null($this->getPerfil()) && $this->getPerfil()->getPessoa()) ? $this->getPerfil()->getPessoa() : 1;
    }

    public function getPerfil(){
        return (!is_null($this->id)) ? $this->getEm()->getRepository('Zf2User\Entity\Perfil')->findOneById($this->id) : null;
    }

    public function getEstados(){
        return $this->getEm()->getRepository('Zf2Base\Entity\Estado')->fetchPairs();
    }

    public function getEm(){
        return $this->em;
    }
}
