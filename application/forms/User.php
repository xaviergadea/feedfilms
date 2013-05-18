<?php
class Application_Form_User extends Zend_Form
{
	public function init()
	{
		$this->setName('user');
		
		$id = new Zend_Form_Element_Hidden('id_user');
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
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty')
			->addValidator('EmailAddress');
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');

		$phone = new Zend_Form_Element_Text('phone');
		$phone->setLabel('Phone')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('NotEmpty');
		
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Description')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$photo = new Zend_Form_Element_File('photo');
		$photo->setLabel('Photo')
			  ->addValidator('NotEmpty')
			  ->setDestination(APPLICATION_PATH.'/../public/uploads');
		
		$rol = new Zend_Form_Element_Select('rol');
		$rol->setLabel('Role')
			->setRequired(true)
			->setMultiOptions($this->_getRolesPair())
			->setValue('20')
			->addValidator('NotEmpty');
		
// 		$rol = new Zend_Form_Element_Select('rol');
// 		$rol->setLabel('Role')
// 		->setRequired(true)
// 		->setMultiOptions(array(1=>'Sysadmin', 2=>'Administrator', 3=>'User'))
// 		->addValidator('NotEmpty');
		
// 		$coders = new Zend_Form_Element_Radio('coders');
// 		$coders->setLabel('Coders')
// 		->setRequired(true)
// 		->setMultiOptions(array(1=>'php', 2=>'java'))
// 		->addValidator('NotEmpty');
		
// 		$city = new Zend_Form_Element_Select('cities_idcity');
// 		$city->setLabel('City')
// 		->setRequired(true)
// 		->setMultiOptions(array(1=>'NY', 2=>'ZGZ', 3=>'BCN'))
// 		->addValidator('NotEmpty');
		
// 		$languages = new Zend_Form_Element_MultiCheckbox('languages');
// 		$languages->setLabel('Languages')
// 		->setRequired(true)
// 		->setMultiOptions(array(1=>'English', 2=>'Spanish', 3=>'Dutch'))
// 		->addValidator('NotEmpty');
		
// 		$pets = new Zend_Form_Element_Multiselect('pets');
// 		$pets->setLabel('Pets')
// 		->setRequired(true)
// 		->setMultiOptions(array(1=>'Gato', 2=>'Tigre', 3=>'Lobo'))
// 		->addValidator('NotEmpty');
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $name, $email, $password,
		        $phone,$description,$photo,$rol,$submit));
	}
	
	protected function _getRolesPair()
	{
		$roles = new Application_Model_DbTable_Roles();
		$arr=$roles->getPair('id_rol','role_name');
		return $arr;
	}
}