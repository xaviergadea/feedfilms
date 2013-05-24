<?php

class Application_Model_DbTable_Usershasfestivals extends Zend_Db_Table_Abstract
{

    protected $_name = 'users_has_festivals';

    public function getUserInFestival($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_uhf = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    public function getFestivalsOfUser($id_user)
    {
    	$id_user = (int)$id_user;
    	$row = $this->fetchAll('acl_users_id = ' . $id_user);
    	$arrRows= $row->toArray();
    	$returnArray=array();
    	foreach ($arrRows as $d):
    		array_push ($returnArray,$d["festivals_id"]);
    	endforeach;
    	return $returnArray;
    }
    public function addUserInFestival($id,$id_festival)
    {
    	$data = array(
    			'acl_users_id' => $id,
    			'festivals_id' => $id_festival,
    	);
        $this->insert($data);
    }

    public function updateUserInFestival($id, $data)
    {
       unset($data["submit"]);
       $this->update($data, 'id = '. (int)$id);
    }

    public function deleteUserInFestival($id,$id_festival)
    {
        
    	$this->delete('acl_users_id =' . (int)$id . " AND festivals_id=".(int)$id_festival);
    }

}

