<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout->setLayout('backend');
    }

    public function indexAction()
    {
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
    }
    
    public function addAction()
    {
    	$model = new Application_Model_User();
    	$form = new Application_Form_User();     
        $form->submit->setLabel('Add');        
        $this->view->form = $form;
        $form->photo->setValueDisabled(true);
        
        if ($this->getRequest()->isPost()) {
//         	if(!$form->getValue('photo'))
//         		$newname='';
//         	else {
        		$newname=$model->renameImage($form->getValue('photo'));
        		$form->photo->setValue($newname);
//         	}
        	
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$phone = $form->getValue('phone');
        		$description = $form->getValue('description');
        		$rol = $form->getValue('rol');
        		
        		$form->photo->addfilter('Rename', $newname);
        		if (!$form->photo->receive())
        		{
        			print "Upload error";
        		}
        		$photo = $newname;
        		        		
//         		$user = new Application_Model_User();
//         		$user->setName($name);
//         		$user->setEmail($email);
//         		$user->setPassword($password);
        		        		
        		$users = new Application_Model_DbTable_Users();          		  
        		$users->addUser($name, $email, $password, $description,
        		        $photo, $rol
        		        	);
        		        	
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    public function editAction()
    {
        $form = new Application_Form_User();
        
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        	    $iduser =  $form->getValue('id_users');
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$password = $form->getValue('password');
        		$phone = $form->getValue('phone');
        		$description = $form->getValue('description');
        		$rol = $form->getValue('rol');
        		
//         		$user = new Application_Model_User();
//         		$user->setIduser($iduser);
//         		$user->setName($name);
//         		$user->setEmail($email);
//         		$user->setPassword($password);
        		
        		$users = new Application_Model_DbTable_Users();
//         		$users->updateUser($user);
        		$users->updateUser($name, $email, $password, $description,
        		        $photo, $rol
        		        	);

        		
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('idusers', 0);
        	if ($id > 0) {
        		$users = new Application_Model_DbTable_Users();
        		$form->populate($users->getUser($id));
        	}
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost())
        {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') 
        	{
        		$iduser = $this->getRequest()->getPost('idusers');
        		$users = new Application_Model_DbTable_Users();
        		$users->deleteUser($iduser);
        	}
        	$this->_helper->redirector('index');
        } else 
        {
        	$iduser = $this->_getParam('idusers', 0);
        	$users = new Application_Model_DbTable_Users();
        	$this->view->user = $users->getUser($iduser);
        }
    }


}
