<?php
//echo($_POST['criteria'].' '.$_POST['id']);
//$criteria = $_POST['criteria'];
//$criteria_id = $_POST['id'];
include '../db_initializer.php';
/********************Declarations*********************/
$user = array();
$test = array();
$question = array();
$report = array();
/*******************fetch users**********************/
$query = "SELECT uid, concat(fname,' ',lname) as name FROM user_details";
$result = mysqli_query($connection,$query);
if(!$result){
    die("DB connection failed");
    exit;	
}
while($row=mysqli_fetch_assoc($result)){
    $id = $row['uid'];
    $user[$id] = ucfirst($row['name']);
}
/******************Fetch Tests************************/
$query = "SELECT testid, testname FROM tests";
$result = mysqli_query($connection,$query);
if(!$result){
    die("DB connection failed");
    exit;	
}
while($row=mysqli_fetch_assoc($result)){
    $id = $row['testid'];
    $test[$id] = ucfirst($row['testname']);
}
/******************Fetch Questions************************/
$query = "SELECT qid, title FROM questions";
$result = mysqli_query($connection,$query);
if(!$result){
    die("DB connection failed");
    exit;	
}
while($row=mysqli_fetch_assoc($result)){
    $id = $row['qid'];
    $question[$id] = ucfirst($row['title']);
}
/******************Fetch Report************************/
$query = "SELECT uid,testid,qid,usr_solution,score,time,space FROM user_test_records";// WHERE ".$criteria." = ".$criteria_id;
$result = mysqli_query($connection,$query);
if(!$result){
    die("No data retrieved");
    exit;	
}
$count = 0;
while($row=mysqli_fetch_assoc($result)){
    
    $report[$count]['name'] = $user[$row['uid']];
    $report[$count]['testname'] = $test[$row['testid']];
    $report[$count]['title'] = $question[$row['qid']];
    $report[$count]['usr_solution'] = $row['usr_solution'];
    $report[$count]['score'] = $row['score'];
    $report[$count]['time'] = $row['time'];
    $report[$count]['space'] = $row['space'].'KB';
    $count++;
}

echo json_encode($report);