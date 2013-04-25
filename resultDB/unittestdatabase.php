<?php

require_once "databaseinterface.php";
require_once "DB.php";

// Implement the database interface
class unittestdatabase implements iDatabase
{
	private $pdo;
	
	public function Connect()
	{		$TableNames;
		$this->pdo = new PDO('mysql:host=localhost;dbname=unittests', '', '');
		$sql = "SHOW TABLES FROM UNITTESTS";
		$statement = $this->pdo->query($sql);
	    if (!empty($statement))
		{
	        while($row = $statement->fetch(PDO::FETCH_NUM))
	        {	           
	           preg_match('/(.*)id$/', $row[0] , $captured);
	           if (!empty($captured)) {
	              $TableNames[]=$captured[0];	
	           }           
	        }
		}
		$WHERE="";
		$FROM="";
		$SELECT="";		
		foreach ($TableNames as $TN)
		{
		    $SELECT .= "$TN.NAME,";
		    $WHERE .= "SUMMARY.$TN=$TN.ID AND ";
		    $FROM .= "$TN,";		    
		}
		
		$sql= "CREATE OR REPLACE VIEW mysummary (".
		      substr($FROM, 0, strlen($FROM) - strlen(",")).") AS SELECT " .
		      substr($SELECT, 0, strlen($SELECT) - strlen(",")) . " FROM SUMMARY," . 
		      substr($FROM, 0, strlen($FROM) - strlen(",")) . " WHERE ". 
		      substr($WHERE, 0, strlen($WHERE) - strlen("AND "));
		//print_r($TableNames);
		//$sql = "CREATE OR REPLACE VIEW mysummary (SWID, TESTNAME, BB, FC, Date) as SELECT swid.LABEL, TESTID.TESTNAME, BBID.NAME, FCID.NAME, SUMMARY.DATE FROM Swid, TESTID, BBID, FCID, SUMMARY WHERE SUMMARY.SWID=swid.iD AND SUMMARY.TESTID=TESTID.ID AND SUMMARY.BBID=BBID.ID AND SUMMARY.FCID=FCID.ID";
		
		$statement = $this->pdo->query($sql);
	}
    public function Disconnect()
    {
		print "Disconnect";
	}

	public function RetrieveHeaderNames()
	{
		$headerNames = "";
		
		$sql = "SHOW COLUMNS FROM MYsummary";
		
		$statement = $this->pdo->query($sql);
		if (!empty($statement))
		{
	        while($row = $statement->fetch(PDO::FETCH_ASSOC))
	        {        
	           $headerNames[] = $row['Field'];
	        }
		}
		return $headerNames;
	}
	
	/*public function RetrieveTableData($ColumnNames)*/
	public function RetrieveTableData($filter)	
	{
		$json=array();
		
		$sql = "SELECT * from MYsummary $filter";
		
		$statement = $this->pdo->query($sql);
		
		if (!empty($statement))
		{
		    while($row = $statement->fetch(PDO::FETCH_NUM))
	        {        
	        	$json[]=$row;        	
	        }
		}		
        return $json;
	}
	
	public function RetrieveTableFields()	
	{
		$Fields = $this->RetrieveHeaderNames();
		$returnData = array();
		foreach ($Fields as $Field)
		{
		   $sql = "SELECT DISTINCT($Field) from MYsummary";
		   $statement = $this->pdo->query($sql);
		
		   $json = array();
		   $json[] = $Field;
	       while($row = $statement->fetch(PDO::FETCH_NUM))
           {        
        	  $json[]=$row;        	
           }
           $returnData[]=$json;
		}
        return $returnData;
	}
	
    public function RetrieveTableField($field)	
	{
		   $returnData = array();
		   $sql = "SELECT DISTINCT($field) from MYsummary";
		   $statement = $this->pdo->query($sql);
				   
	       while($row = $statement->fetch(PDO::FETCH_NUM))
           {        
        	  $returnData[]=$row;        	
           }
           
		
        return $returnData;
	}
	
	public function RetrieveSortedTableData($x, $y, $z, $filter)	
	{		
		$sql = "SELECT $x, $y from MYsummary $filter";
		$statement = $this->pdo->query($sql);
	
		while($row = $statement->fetch(PDO::FETCH_NUM))
        {                	
        	$columnName[$row[0]] = "a";
        	$rowName[$row[1]]="b";
        }
        
        foreach ($columnName as $col => $val1)
        {
        	foreach ($rowName as $row => $val2)
        	{        		        		
        		$matrix[$col][$row] = "-";           		
        	}
        }             
        
        $label[]=$x;
	    foreach ($rowName as $row => $val)
	    {        		        		        	
        	$label[]=$y . $row;     	
        }
		
		$sql = "SELECT $x, $y, $z from MYsummary $filter";
		$statement = $this->pdo->query($sql);
		
	    while($row = $statement->fetch(PDO::FETCH_NUM))
        {        	
        	$matrix[$row[0]][$row[1]] = $row[2];       
        }       
       
        
        
        foreach ($matrix as $key => $val)
        {        	
        	$mymatrix = array();
        	$mymatrix[]=$key;
        	foreach ($val as $column)
            {
               $mymatrix[]=$column;
            }
            $json[]=$mymatrix;            
        }
        
        $returnjson[]=$label;
        $returnjson[]=$json;
     
        return $returnjson;
	}
}

?>