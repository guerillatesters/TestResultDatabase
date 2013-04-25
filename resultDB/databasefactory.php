<?php

require_once "databaseinterface.php";
require_once "mysqldatabase.php";
require_once "unittestdatabase.php";

class DatabaseCreator
{
	public function Create($DatabaseType)
	{
		if ($DatabaseType == "mysql")
		{
			return new mysqldatabase();
		}
		else if ($DatabaseType == "unit")
		{
		    return new unittestdatabase(); 
		}
		else
		{
			// Not supported yet
		}
	}
}

?>