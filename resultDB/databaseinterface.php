<?php

// Declare the interface 'iDatabase'
interface iDatabase
{
    public function Connect();
    public function Disconnect();
    public function RetrieveHeaderNames();
    public function RetrieveTableData($filter);
    public function RetrieveSortedTableData($x, $y, $z, $filter);
}

?>