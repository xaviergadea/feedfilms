<?php

class Application_Model_User
{

    public function renameImage($name)
    {
        $destination=Zend_Registry::get('uploadDirectory');
    	$path_parts = pathinfo($destination.'/'.$name);
    	$name=$path_parts['filename'].".".$path_parts['extension'];
    	$i=0;
    	while(in_array($name,scandir($destination)))
    	{
    		$i++;
    		$name=$path_parts['filename']."_".$i.".".$path_parts['extension'];
    	}
    	return $name;
    }
}

