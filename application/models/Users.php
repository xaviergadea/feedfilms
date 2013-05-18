<?php

class Application_Model_Users extends Zend_Db_Table
{
	private $_table;
	public function getTable(){
		$this->_table=new Application_Model_DbTable_Users();
	}
	
	public function fetchSQL($sql)
	{
		$table=$this->getTable()->getAdapter()->fetchAssoc($sql);
		return $table;
	}
}

