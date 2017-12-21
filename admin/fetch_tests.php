<?php
include '../db_initializer.php';
/********************Declarations*********************/
$test = array();
/******************Fetch Tests************************/
$query = "SELECT testid, testname,no_of_ques,start_date,start_time,duration,active FROM tests";
$result = mysqli_query($connection,$query);
if(!$result){
    die("DB connection failed");
    exit;	
}
$count=0;
while($row=mysqli_fetch_assoc($result)){
    $test[$count]['testid'] = $row['testid'];
    $test[$count]['testname'] = ucfirst($row['testname']);
    $test[$count]['no_of_ques'] = $row['no_of_ques'];
    $test[$count]['start_date'] = $row['start_date'];
    $test[$count]['start_time'] = 'T'.$row['start_time'];
    $test[$count]['duration'] = $row['duration'];
    $test[$count]['active'] = $row['active'];
    $count++;
}

echo json_encode($test);