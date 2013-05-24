<?php

class Application_Model_DbTable_Festivals extends Zend_Db_Table_Abstract
{

    protected $_name = 'festivals';

    public function getFestival($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
   
    public function addFestival($data)
    {
    	unset($data["submit"]);
        $this->insert($data);
    }

    public function updateFestival($id, $data)
    {
       unset($data["submit"]);
       $this->update($data, 'id = '. (int)$id);
    }

    public function deleteFestival($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

