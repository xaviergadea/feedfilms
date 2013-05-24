<?php

class Application_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setName('User');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
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
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $city = new Zend_Form_Element_Select('city');
        $city->setLabel('City')
                ->setRequired(true)
                ->setMultiOptions(array('1'=>'Barcelona', '2'=>'Bilbao', '3'=>'Paris'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $gender = new Zend_Form_Element_Radio('gender');
        $gender->setLabel('Gender')
                ->setRequired(true)
                ->setMultiOptions(array('F'=>'female', 'M'=>'male', 'O'=>'other'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $pet = new Zend_Form_Element_MultiCheckbox('pets');
        $pet->setLabel('Pets')
                ->setRequired(true)
                ->setMultiOptions(array('T'=>'Tiger', 'C'=>'Cat', 'D'=>'Dog'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $languages = new Zend_Form_Element_Multiselect('language');
        $languages->setLabel('Language')
                ->setRequired(true)
                ->setMultiOptions(array('E'=>'English', 'S'=>'Spanish', 'C'=>'Català'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $name, $password, $email, $description, $photo, $city, 
                                $gender, $pet, $languages, $submit));
    }
}