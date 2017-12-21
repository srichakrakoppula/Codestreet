<?php
if(!isset($_GET['type']))
	header("Location: index.php");
$type = $_GET['type'];
include '../db_initializer.php';

if($type=='q_titles')
	$query = "SELECT qid,title FROM questions";
else if($type=='t_names')
	$query = "SELECT testid,testname FROM tests";
else if($type=='u_names')
	$query = "SELECT uid,concat(fname,' ',lname) as name FROM user_details";
else
	header("Location: index.php");
$result = mysqli_query($connection,$query);
if(!$result){
	die("DB connection failed");
	exit;	
}
$data = array();

if($type=='q_titles'){
	while($row=mysqli_fetch_assoc($result)){
	  $id = $row['qid'];
	  $data[$id] = ucfirst($row['title']);
	}
}else if($type=='t_names'){
	while($row=mysqli_fetch_assoc($result)){
	  $id = $row['testid'];
	  $data[$id] = ucfirst($row['testname']);
	}
}else if($type=='u_names'){
	while($row=mysqli_fetch_assoc($result)){
	  $id = $row['uid'];
	  $data[$id] = ucfirst($row['name']);
	}
}
//print_r($data);
header('Content-type: application/json');
echo json_encode($data);