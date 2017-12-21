<?php 
include 'db_initializer.php';

$username=$_POST['user_name'];
//$username = "srichakra";
$query = "SELECT * FROM user_details WHERE uid='{$username}'";
$result = mysqli_query($connection,$query);
if(!$result){
	echo 'Database connection failed';exit;
	}
else if(strlen($username) < 6 || strlen($username) > 15){
	echo '<span class="errmsgs">Username must be 6 to 15 characters</span>';
	}
else if (preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    if($row=mysqli_fetch_row($result)) {
		echo '<span class="errmsgs">Username already exists</span>';exit;
		}
	else{
		echo '<span class="success" >Username available</span>';
		}
	} 
else {
      echo '<span class="errmsgs">Use alphanumeric characters only.</span>';
	}
mysqli_close($connection);
?>