<?php
class Application_Form_Festival extends Zend_Form
{
	public function init()
	{
		$this->setName('festival');
		
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setOptions(array('class'=>'text-input'))
			->setDecorators(array(array('ViewScript', array(
	                                    'viewScript' => 'forms/_element_text.phtml'
	                                ))));
		
		$edition = new Zend_Form_Element_Text('edition');
		$edition->setLabel('Edition')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->setOptions(array('class'=>'text-input'))
			->setDecorators(array(array('ViewScript', array(
	                                    'viewScript' => 'forms/_element_text.phtml'
	                                ))));
		
		$location = new Zend_Form_Element_Text('location');
		$location->setLabel('Location')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->setOptions(array('class'=>'text-input'))
				->setDecorators(array(array('ViewScript', array(
	                                    'viewScript' => 'forms/_element_text.phtml'
	                                ))));
		

		$date = new Zend_Form_Element_Hidden('date');
		$date->setValue(date("Y-m-d"));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $name, $edition, $location,
		        $date,$submit));
	}
	
	protected function _getRolesPair()
	{
		$roles = new Application_Model_DbTable_Roles();
		$arr=$roles->getPair('id_rol','role_name');
		return $arr;
	}
}