<?php

class Application_Form_linkfestivals extends Zend_Form
{
	protected $_festivalsRows;
	
	public function __construct($festivalsRows)
	{
		$this->_festivalsRows = $festivalsRows;
	}

    public function init()
    {
        $this->setName('linkfestivals');

        $id = new Zend_Form_Element_Hidden('user_id');
        $id->addFilter('Int');
		
        foreach($this->_festivalsRows as $festivals) :
	        $chkfestivals = new Zend_Form_Element_Checkbox('festival_id');
	        $chkfestivals->setLabel('aa')
	        		->setId($festivals->id)
	               	->setRequired(false);
	        		               		       
        endforeach; 
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('user_id', 'submitbutton');
        
        $this->addElements(array($id, $chkfestivals,$submit));
    }
}