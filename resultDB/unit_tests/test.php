<?php
require_once "C:/Users/tim_meacham/Documents/GitHub/TestResultDatabase/resultDB/api.php";

class test extends UnitTestCase {
    
 function test_RetrieveHeaders(){
 $testapi = new Api();
 $data = $testapi->RetrieveHeaders();
 $this->assertEqual($data, "{\"aaData\":[\"SummaryID\",\"TestName\",\"Actual\",\"SWID\"]}");
 }
 
 // TC: Request results without specifying any filter
 function test_RetrieveTableDataEmptyFilter(){
 $testapi = new Api("mysql");
 $filter = "";
 $data = $testapi->RetrieveTableData ($filter);
 $this->assertEqual($data, "{\"aaData\":[[\"0\",\"BB1\",\"PASS\",\"0\"],[\"1\",\"BB2\",\"FAIL\",\"0\"],[\"2\",\"BB3\",\"FAIL\",\"0\"],[\"4\",\"BB1\",\"PASS\",\"2\"]]}");
 } 
 
 // TC: Request results specifying one filter set
 function test_RetrieveTableDataOneFilter(){
 $testapi = new Api("mysql");
 $filter = Array ("TestName" => "BB1,BB2");
 $data = $testapi->RetrieveTableData ($filter);
 $this->assertEqual($data, "{\"aaData\":[[\"0\",\"BB1\",\"PASS\",\"0\"],[\"1\",\"BB2\",\"FAIL\",\"0\"],[\"4\",\"BB1\",\"PASS\",\"2\"]]}");
 }

 // TC: Request results specifying two filter sets
 function test_RetrieveTableDataTwoFilters(){
 $testapi = new Api("mysql");
 $filter = Array ("TestName" => "BB1,BB2", "SWID" => "2");
 $data = $testapi->RetrieveTableData ($filter);
 $this->assertEqual($data, "{\"aaData\":[[\"4\",\"BB1\",\"PASS\",\"2\"]]}");
 }
 
 // TC: Request results with combinations that don't give results
function test_RetrieveTableDataNoResults(){
 $testapi = new Api("mysql");
 $filter = Array ("TestName" => "BB5", "SWID" => "2");
 $data = $testapi->RetrieveTableData ($filter);
 $this->assertEqual($data, "{\"aaData\":[]}");
 }
 
 // TC: Request results with combinations that don't give results
function test_sortedTableDataNoFilter(){
 $testapi = new Api("mysql");
 $filter = Array ("TestName" => "", "SWID" => "", "Actual" => "");
 $data = $testapi->RetrieveSortedTableData ($filter);
 $this->assertEqual($data, "{\"aaData\":[]}");
 }
 
}
?>