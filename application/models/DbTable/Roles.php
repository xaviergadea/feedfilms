<?php

class Application_Model_DbTable_Roles extends Zend_Db_Table_Abstract
{

    protected $_name = 'acl_roles';

    public function getRol($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_rol = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    /**
     * Get id, value pair array
     * 
     * @param string $id_column
     * @param string $value_column
     * @throws Exception
     * @return array: id=>value
     */
	public function getPair($id_column, $value_column)
	{
		$pairs=array();
		$rows = $this->fetchAll();
		if (!$rows) {
			throw new Exception("Could not find row $id");
		}
		foreach($rows as $row)
		{
			$pairs[$row[$id_column]]=$row[$value_column];
		}

		return $pairs;
	}

}

