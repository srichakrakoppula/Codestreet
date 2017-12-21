<?php
//var_dump($_POST);
//exit;

include('../db_initializer.php');
$title = mysqli_real_escape_string($connection,$_POST['title']);
$question = mysqli_real_escape_string($connection,$_POST['question']);
$input_desc = mysqli_real_escape_string($connection,$_POST['input_desc']);
$output_desc = mysqli_real_escape_string($connection,$_POST['output_desc']);
$constraints = mysqli_real_escape_string($connection,$_POST['constraints']);
$ex_input = mysqli_real_escape_string($connection,$_POST['ex_input']);
$ex_output = mysqli_real_escape_string($connection,$_POST['ex_output']);
$no_of_tcs = mysqli_real_escape_string($connection,$_POST['no_of_tcs']);
$i=1;
$tc_in = array();
$tc_out = array();
while(isset($_POST['in_'.$i])&&isset($_POST['out_'.$i])){
	$tc_in[$i] = $_POST['in_'.$i];
	$tc_out[$i] = $_POST['out_'.$i];
	$i++;
}
//echo $title.'<br/>';
//echo $question.'<br/>';
//echo $input_desc.'<br/>';
//echo $output_desc.'<br/>';
//echo $constraints.'<br/>';
//echo $ex_input.'<br/>';
//echo $ex_output.'<br/>';
//print_r($tc_in);
//print_r($tc_out);


//////////Inserting Question///////////////
$query = "INSERT INTO questions(title,question,input_desc,output_desc,constraints,ex_input,ex_output) VALUES('{$title}','{$question}','{$input_desc}','{$output_desc}','{$constraints}','{$ex_input}','{$ex_output}')";
$qid = 0;
if(mysqli_query($connection,$query)){
	$qid = mysqli_insert_id($connection); 
}else{
	die("Couldn't insert question.");
	exit;
}
//echo $qid;
for($i=1;$i<=$no_of_tcs;$i++){
	$tcid=0;
	$query = "INSERT INTO testcases(inputstream,outputstream) VALUES('{$tc_in[$i]}','{$tc_out[$i]}')";
	if(mysqli_query($connection,$query)){
		$tcid = mysqli_insert_id($connection);
		$query = "INSERT INTO q2tcmap(qid,tcid) VALUES({$qid},{$tcid})";
		if(mysqli_query($connection,$query)){
			header("Location: success.php?type=question&id=".$qid);
		}
		else{
			die("Couldn't insert row in q2tcmap.");
			exit;	
		}
	}else{
		die("Couldn't insert tcs.");
		exit;
	}
}
