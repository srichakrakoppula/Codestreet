<?php
include 'db_initializer.php';
$uid = $_POST['username'];
$page_to_redirect = $_POST['redirect_to'];
$password = $_POST['password'];
$hash_password = crypt($password,'$2a$09$srichakrakoppula$');
$query = "SELECT password FROM user_details WHERE uid='{$uid}'";

$result = mysqli_query($connection,$query);

if(!$result){
	header("Location: ".$page_to_redirect."?");	
}
else{
	$row = mysqli_fetch_assoc($result);
	if(!$row){
		header("Location: ".$page_to_redirect."?".urlencode("Unable to login"));
	}
	if(hash_equals($hash_password,$row['password'])){
		//header("Location: ".$page_to_redirect."?".urlencode("pswdmatched"));
		$query = "SELECT fname,admin FROM user_details WHERE uid='{$uid}'";
		$result = mysqli_query($connection,$query);
		$row = mysqli_fetch_assoc($result);
		if(!$row){
			header("Location: ".$page_to_redirect."?".urlencode("Unable to login"));	
		}
		$name = $row['fname'];
		$isadmin = $row['admin'];
		session_start();
		$_SESSION['admin_id'] = $uid;
		$_SESSION['name'] = ucfirst($name);
		if($isadmin==1){
			$_SESSION['isadmin'] = true;
			header("Location: admin/admin.php");
		}
		else{
			$_SESSION['isadmin'] = false;
			header("Location: ".$page_to_redirect);
		}
	}
	else{
		header("Location: ".$page_to_redirect."?".urlencode("Username_or_Password_doesnt_match"));
	}
	
}