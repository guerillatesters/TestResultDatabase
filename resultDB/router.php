<?php

require_once "api.php";

$filter="";
$api = new Api("unit");

/*
if (isset($_POST['request']))
{
   if ($_POST['request']=="headers")
   {
       // Example of post   	  
   }
}*/

if (isset($_GET['headers']))
{
   print $api->RetrieveHeaders();   	 
}
else if (isset($_GET['tableData']) )
{	 
    $filter = "";
    if (isset($_GET['filter']))
    {
       $filter = $_GET['filter'];
    }
   print $api->RetrieveTableData($filter);   
}
else if (isset($_GET['sortedTableData']))
{	
    $filter = "";
    if (isset($_GET['filter']))
    {
       $filter = $_GET['filter'];
    }
	  print $api->RetrieveSortedTableData($filter);
}
else if (isset($_GET['RetrieveTableFields']))
{	    
   	  print $api->RetrieveTableFields();          
}
else if (isset($_GET['RetrieveTableField']) && isset($_GET['field']))
{	
   	  print $api->RetrieveTableField($_GET['field']);           
}
?>