<?php

class JudgesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */ 
    	$this->_helper->layout->setLayout('backend');
    	
    	/* Initialize contextSwitch to use Ajax delete judge from film */
    	
    	/*
    	$contextSwitch = $this->_helper->getHelper('contextSwitch');
    	$contextSwitch->addActionContext('linkfestivalsdelete', 'json')
    	->addActionContext('linkfestivalsadd', 'json')
    	->initContext();*/
    }

    public function indexAction()
    {
        $judges = new Application_Model_DbTable_Users();
        $rows=$judges->getUserByRol(21);       
        $this->view->judges = $rows;
    }
	public function linkfestivalsAction()
	{
		$festivals = new Application_Model_DbTable_Festivals();
		$this->view->festivals = $festivals->fetchAll();
		
		$UsersHasFestivals = new Application_Model_DbTable_Usershasfestivals();
		$this->view->usershasfestivals = $UsersHasFestivals->getFestivalsOfUser($this->_getParam('id', 0));
		//print_r($this->view->usershasfestivals);
		$this->view->id_judge = $this->_getParam('id', 0);
		//$form = new Application_Form_linkfestivals($this->view->festivals);
		//$form->submit->setLabel('Ok');
		//$this->view->form = $form;
	}
	
	public function linkfestivalsdeleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$id_festival = $this->getRequest()->getPost('id_festival');
				$festival = new Application_Model_DbTable_Usershasfestivals();
				$festival->deleteUserInFestival($id,$id_festival);
				
				$this->_redirect('/judges/linkfestivals/id/'.$id);
				//$this->_helper->json("ok");
			}
			
		} else {
			$this->view->id = $this->_getParam('id', 0);
			$this->view->id_festival = $this->_getParam('id_festival', 0);
			$festivals = new Application_Model_DbTable_Festivals();
			$this->view->festivals = $festivals->getFestival($this->view->id_festival);
			
		}
		
	}
    public function linkfestivalsaddAction()
    {
       
		$id = $this->_getParam('id', 0);
		$id_festival = $this->_getParam('id_festival', 0);
        $festival = new Application_Model_DbTable_Usershasfestivals();
		$festival->addUserInFestival($id,$id_festival);
		$params = array('id' => $id);
		$this->_redirect('/judges/linkfestivals/id/'.$id);
		   
		//$this->_helper->json("ok");
            
    }

    public function editAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id, $artist, $title);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_DbTable_Albums();
                $form->populate($albums->getAlbum($id));
            }
        }
        
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}







