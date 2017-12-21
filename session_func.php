<?php 
session_start();

function loggedin(){
	return 	isset($_SESSION['admin_id']);
}

function confirmLoggedIn(){
	if(!loggedin()){
		header('Location: index.php');	
	}	
}

function confirmAdmin(){
	if(($_SESSION['isadmin']===false))
		header('Location: index.php');
}