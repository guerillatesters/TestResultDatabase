<?php

require_once "databasefactory.php";

$arr = get_defined_vars();
$filter="";
//print_r($arr);

class Api
{
    function __construct( $database="mysql")
    {
        $this->db = new DatabaseCreator();
        $this->database = $this->db->Create($database);
        $this->database->Connect();    
    }
    
    function RetrieveHeaders()
	{
       $HeaderNames = $this->database->RetrieveHeaderNames();     
       $data["aaData"] = $HeaderNames;
       return json_encode($data);	
	}
	
	function RetrieveTableData ($filterList)
	{	   	    
	    $filter="";
	    if (!empty($filterList))
	    {
      	  $filter .= "WHERE ";      	
	      foreach ($filterList as $key => $value)
	      {
	      	 $val = preg_replace('/(\w+[a-zA-Z0-9])/', '\'$1\'' , $value);
	      	 //print $val . ":\r\n";
	         $filter .= "$key IN ($val)"; // TODO: single letters are not replaced	         		     
		     $filter .= " AND ";
		  }
	      $filter = substr($filter, 0, (strlen($filter) - strlen(" AND ")) );
	    }      
      $tableData["aaData"] = $this->database->RetrieveTableData($filter);            
      return json_encode($tableData);      
    }

    function RetrieveSortedTableData($filter)
    {
        // TODO: fix when filter is empty
      	 $filter = "WHERE ";
      	 $keys = array();      	
	      foreach ($_GET['filter'] as $key => $value)
	      {
	      	 $val = preg_replace('/(\w+[a-zA-Z0-9])/', '\'$1\'' , $value);	      	 
	         $filter .= "$key IN ($val)"; // TODO: single letters are not replaced	         		     
		     $filter .= " AND ";		     
		     $keys[] = $key;
		  }
	      $filter = substr($filter, 0, (strlen($filter) - strlen(" AND ")) );

      $returnData = $this->database->RetrieveSortedTableData($keys[0], $keys[1], $keys[2], $filter);
      $json["labels"] = $returnData[0];
      $json["aaData"] = $returnData[1];
                    
      return json_encode($json);      
    } 
       
    function RetrieveTableFields ()
    {	   	 
        $returnData = $this->database->RetrieveTableFields();
        return json_encode($returnData);      
    }
    
    function RetrieveTableField ($field)
    {
        $returnData = $this->database->RetrieveTableField($field);      
        return json_encode($returnData);
    }
    
    private $db;
    private $database;
}
?>