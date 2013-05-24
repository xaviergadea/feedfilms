<?php

class FestivalsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */ 
    	$this->_helper->layout->setLayout('backend');
    }

    public function indexAction()
    {
        $festivals = new Application_Model_DbTable_Festivals();
        $this->view->festivals = $festivals->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Festival();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $festival = new Application_Model_DbTable_Festivals();
                $festival->addFestival($formData);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
            
    }

    public function editAction()
    {
        $form = new Application_Form_Festival();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	$id = $this->_getParam('id', 0);
                $festival = new Application_Model_DbTable_Festivals();
                $festival->updateFestival($id,$formData);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $festival = new Application_Model_DbTable_Festivals();
                $form->populate($festival->getFestival($id));
            }
        }
        
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->_getParam('id', 0);
                
                $festival = new Application_Model_DbTable_Festivals();
                $festival->deleteFestival($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $festival = new Application_Model_DbTable_Festivals();
            $this->view->festival = $festival->getFestival($id);
        }
    }


}







