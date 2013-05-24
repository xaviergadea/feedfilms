<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_users';

    public function getUser($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_user = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    public function getUserByRol($role_id)
    {
    	$role_id = (int)$role_id;
    	$row = $this->fetchAll('acl_roles_id_rol = ' . $role_id);
    	if (!$row) {
    		throw new Exception("Could not find row $id");
    	}
    	return $row->toArray();
    }
	public function addUser($name, $email, $password, $description,
        		        $photo, $rol
        		        	)
	{
		$date = new Zend_Date();
		
		$data = array(
				'name' => $name,
		        'email' => $email,
		        'password' => $password,
		        'description' => $description,
		        'photo' => $photo,
		        'acl_roles_id_rol' => $rol,
		        'date' => $date->get('yyyy-MM-dd'),
				'status' => 1		        
		);
		$this->insert($data);
	}

    public function updateUser($iduser,$name, $email, $password, $description,
        		        $photo, $rol)
    {
    	$data = array(
				'name' => $name,
		        'email' => $email,
		        'description' => $description,
// 		        'photo' => $photo,
		        'acl_roles_id_rol' => $rol		        		        
		);
    	
    	
        $this->update($data, 'id_user = '. (int)$iduser);

    }

    public function deleteUser($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

