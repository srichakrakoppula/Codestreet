<?php 
if(!isset($_POST['submit'])){
	header('Location: index.php');	
}
include 'db_initializer.php';

//var_dump($_POST);
//exit;
/////////////////........Get Variables from posted data........////////////////////
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$uid = $_POST['username'];
$password = $_POST['pswd'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$email = $_POST['email'];
$contact = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
$dob = $_POST['dob'];

$query = "SELECT * FROM user_details WHERE uid='{$uid}'";
$result = mysqli_query($connection,$query);

if(strlen($uid) < 6 || strlen($uid) > 15){
	header('Location: register.php?'.urlencode("Username must be 6 to 15 characters"));
	}
else if (preg_match("/^[a-zA-Z0-9]+$/", $uid)) {
    if($row=mysqli_fetch_row($result)) {
		header('Location: register.php?'.urlencode("Username already exists"));
		exit;
		}
	} 
else {
	  header('Location: register.php?'.urlencode("Use only alphanumeric characters in Username."));
	}
//////////////.........Insert them in database............//////////////////////
$hash_password = crypt($password,'$2a$09$srichakrakoppula$'); 
$query = "INSERT INTO user_details(uid, password, fname, lname, branch, year, contact, dob) VALUES('{$uid}','{$hash_password}','{$fname}','{$lname}','{$branch}','{$year}','{$contact}','{$dob}')";
//echo $query;
//exit;
$result = mysqli_query($connection,$query);
//echo $result;
if(!$result)
	header("Location: reg_fail.html");
else
	header("Location: reg_success.html");
?>
