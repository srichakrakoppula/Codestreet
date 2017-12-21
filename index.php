<?php
 include 'session_func.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Code Street</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/lgn.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<script src="js/jquery-latest.min.js"></script>
<script src="js/lgn_script.js"></script>
<script src="js/validate_lgn.js"></script>
<!--<link href="css/lgn.css" rel="stylesheet" type="text/css">-->

</head>
<body>
<div id="wrapper" > <img id="head_logo" src="images/Header_Logo1.png" width="464" height="100" alt="Code Street Logo"/>
  <div id = "reg_login">
    <ul>
    <?php if(!loggedin()){
			echo '<li><a href="register.php">Register</a> </li>
      		<li><a id="login" href="login.php" class="overlayLink" data-action="login-form.html">Login</a></li>';
		}else{
			echo '<li><a href="#">'.$_SESSION['name'].'</a> </li>
      		<li><a href="logout.php">Logout</a></li>';	
		}
      		
	  ?>
    </ul>
  </div>
  <div id="nav_bar">
    <ul>
      <li><a class="thispage" href="index.php">Home</a></li>
      <li><a href="compiler.php">Online Compiler</a></li>
      <li><a href="practice.php">Practice</a></li>
      <li><a href="tests.php">Assessment</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </div>
  <!--End of Header and Navigation bar(common to all pages)-->
  <div id="intro" style="text-align:center; padding-top:100px; font-size:40px">
	<?php 
	if(!loggedin())
		{
		echo '<p> Hello! <br/>
Welcome to CodeStreet.
	</p>';}
	else{
		$name= $_SESSION['name'];
		echo '<p> Hello '.$name.'! <br/>
Welcome to CodeStreet.
	</p>';
		}
	?>
</div>
  <div class="overlay" style="display: none;">
    <div class="login-wrapper">
      <div class="login-content" id="loginTarget"> <a class="close">x</a>
        <h3>Sign in</h3>
        <form method="post" onsubmit="return validate_lgn();" action="login.php" >
          <label for="username"> Username:
            <input type="text" name="username" id="username" placeholder="Enter your username"  required />
          </label>
          <input type="hidden" name="redirect_to" value="index.php"/>
          <p id="lgn_err_usrname" style="display:none;font-family:'Lucida Grande', Tahoma, Arial, Verdana, sans-serif; color:#CD1316; font-size:14px;">&nbsp;&nbsp;*Invalid username</p>
          <label for="password"> Password:
            <input type="password" name="password" id="password" placeholder="Enter your password"  required />
          </label>
          <button type="submit">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    <?php 
	if(!loggedin()){
		echo '$("#login").click();';	
	}
	?>
});
</script>
</body>
</html>
