<?php 
//var_dump($_POST);
//exit;
	
include '../db_initializer.php';
$testname = mysqli_real_escape_string($connection, $_POST['testname']);
$no_of_ques = mysqli_real_escape_string($connection,$_POST['no_of_ques']);
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];
$duration = $_POST['duration'];
$qids = $_POST['q_title'];
//print_r($qids);
if($no_of_ques!=sizeof($qids)){
	die("no_of_ques and questions selected didn't match");	
	exit;
}
$query = "INSERT INTO tests(testname,no_of_ques,start_date,start_time,duration,active) VALUES('{$testname}',{$no_of_ques},'{$start_date}','{$start_time}',{$duration},1)";

if(mysqli_query($connection,$query)){
	$testid = mysqli_insert_id($connection);
	
	for($i=0;$i<$no_of_ques;$i++){
		$query = "INSERT INTO t2qmap(testid,qid) VALUES({$testid},{$qids[$i]})";
		//echo $query;
		if(mysqli_query($connection,$query)){
			header("Location: success.php?type=test&id=".$testid);
		}else{
			die("Mapping failed");
			exit;	
		}
	}
}else{
	die("Couldn't create test.");
	exit;
}

