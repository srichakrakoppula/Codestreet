<?php
error_reporting(E_ERROR);
header('Content-type: application/json');
$reportData = $_POST['data'];
//print_r($reportData);

include '../db_initializer.php';
$noOfRecords = count($reportData);
for($i=0;$i<$noOfRecords;$i++){
    $testid = $reportData[$i][0];
    $testname = $reportData[$i][1];
    $start_date = $reportData[$i][2];
    $start_time = substr($reportData[$i][3],1);
    $duration = $reportData[$i][4];
    $active = $reportData[$i][5];
    $query = "UPDATE tests SET "
                . "testname = '$testname',"
                . "start_date = '$start_date',"
                ."start_time = '$start_time', "
                . "duration = '$duration', "
                . "active = {$active} "
            . "WHERE testid = {$testid}";
//    echo $query.'                                         ';
    $result = mysqli_query($connection,$query);
    if(!$result){
        die("DB connection failed");
        exit;	
    }
}

