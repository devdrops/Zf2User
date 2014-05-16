<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Form;

use Zf2User\Entity\Perfil;
use Zend\Form\Fieldset,
	Zend\InputFilter\InputFilterProviderInterface,
	Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class PerfilFieldset extends Fieldset implements InputFilterProviderInterface
{
    private $em = null;
    private $id = null;

 	public function __construct($name = null, $options = array())
	{
        $this->em = $options['em'];
        $this->id = $options['id'];

		parent::__construct($name);
		$this->setHydrator(new ClassMethodsHydrator(false))
			 ->setObject(new Perfil);

        $this->setLabel('Perfil');

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Name',
            ),
            'options' => array(
                'label' => 'Name:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'date_birth',
            'attributes' => array(
                'class' => 'form-control col-xs-12 data_nasc datepicker',
                'placeholder' => 'Date Birth',
            ),
            'options' => array(
                'label' => 'Date Birth:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

		$this->add(array(
            'name' => 'localization',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Localization',
            ),
            'options' => array(
                'label' => 'Localization:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
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
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'avatar_hidden',
            'attributes' => array(
                'id' => 'k13-file-hidden-input',
                'data-title' => '',
                'data-image' => ''
            ),
        ));

        $this->add(array(
            'name' => 'avatar',
            'type' => 'Zend\Form\Element\File',
            'attributes' => array(
                'class' => 'form-control col-xs-12',
                'id' => 'id-input-file',
            ),
            'options' => array(
                'label' => 'Avatar:',
                'label_attributes' => array(
                    'class' => 'col-sm-2 control-label no-padding-right'
                ),
                'multiple' => false,
                'id' => 'avatar',
                'disable_inarray_validator' => true,
            )
        ));
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array();
    }

    public function getEm(){
        return $this->em;
    }
}
