<?php
 include 'session_func.php';
 confirmLoggedIn();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Practice</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/lgn.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<script src="js/jquery-latest.min.js"></script>
<script src="js/lgn_script.js"></script>
<script src="js/validate_lgn.js"></script>
<style>
#display_msg {
	text-align: center;
	font-family: buenard;
	font-style: normal;
	font-weight: 400;
	font-size: x-large;
	top: 200px;
	position: relative;
}
</style>
</head>

<body>
<div id="wrapper" >
  <div id="head_logo"> <img src="images/Header_Logo1.png" width="464" height="100" alt="Code Street Logo"/></div>
  <div id = "reg_login">
    <ul>
      <?php if(!loggedin()){
			echo '<li><a href="register.php">Register</a> </li>
      		<li><a href="login.php" class="overlayLink" data-action="login-form.html">Login</a></li>';
		}else{
			echo '<li><a href="#">'.$_SESSION['name'].'</a> </li>
      		<li><a href="logout.php">Logout</a></li>';	
		}
      		
	  ?>
    </ul>
  </div>
  <div id="nav_bar">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="compiler.php">Online Compiler</a></li>
      <li><a class="thispage" href="practice.php">Practice</a></li>
      <li><a href="tests.php">Assessment</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </div>
  <!--End of Header and Navigation bar(common to all pages)-->
  
  <div class="overlay" style="display: none;">
    <div class="login-wrapper">
      <div class="login-content" id="loginTarget"> <a class="close">x</a>
        <h3>Sign in</h3>
        <form method="post" onsubmit="return validate_lgn();" action="login.php" >
          <label for="username"> Username:
            <input type="text" name="username" id="username" placeholder="Enter your username"  required />
          </label>
          <input type="hidden" name="redirect_to" value="practice.php"/>
          <p id="lgn_err_usrname" style="display:none;font-family:'Lucida Grande', Tahoma, Arial, Verdana, sans-serif; color:#CD1316; font-size:14px;">&nbsp;&nbsp;*Invalid username</p>
          <label for="password"> Password:
            <input type="password" name="password" id="password" placeholder="Enter your password"  required />
          </label>
          <button type="submit">Sign in</button>
        </form>
      </div>
    </div>
  </div>
  
  <div id = "display_msg">
	No Questions yet.
  <p id = "thanks"> Please come back later.</p>
</div>
</div>
</body>
</html>
