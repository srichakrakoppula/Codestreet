<?php
 include 'session_func.php';
 confirmLoggedIn();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tests</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/lgn.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<script src="js/jquery-latest.min.js"></script>
<script src="js/lgn_script.js"></script>
<script src="js/validate_lgn.js"></script>

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
      <li><a href="practice.php">Practice</a></li>
      <li><a class="thispage" href="tests.php">Assessment</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </div>
  <!--End of Header and Navigation bar(common to all pages)--> 
  
  <!--Login overlay begin-->
  <div class="overlay" style="display: none;">
    <div class="login-wrapper">
      <div class="login-content" id="loginTarget"> <a class="close">x</a>
        <h3>Sign in</h3>
        <form method="post" onsubmit="return validate_lgn();" action="login.php" >
          <label for="username"> Username:
            <input type="text" name="username" id="username" placeholder="Enter your username"  required />
          </label>
          <input type="hidden" name="redirect_to" value="tests.php"/>
          <p id="lgn_err_usrname" style="display:none;font-family:'Lucida Grande', Tahoma, Arial, Verdana, sans-serif; color:#CD1316; font-size:14px;">&nbsp;&nbsp;*Invalid username</p>
          <label for="password"> Password:
            <input type="password" name="password" id="password" placeholder="Enter your password"  required />
          </label>
          <button type="submit">Sign in</button>
        </form>
      </div>
    </div>
  </div>
  
  <!--End of overlay for login-->
  <?php 
	$linkids = array(); $testNames = array();
	include 'db_initializer.php';
	$query = 'SELECT testid,testname FROM tests WHERE active = 2';
	$result = mysqli_query($connection,$query);
	$i=0;
	while(($row = mysqli_fetch_assoc($result))){
		$linkids[$i] = $row['testid'];
		$testNames[$i] = $row['testname'];	
		$i++;
	}
	?>
  <div id="test_container">
  <form id="hid_form" method="post" action="questions.php">
  	<ul class="tests">
    <?php 
	$size = sizeof($linkids);
	for($i=0;$i<$size;$i++){
		echo '<li>';
      	echo '<h2 class="test_title"><a id="'.$linkids[$i].'" href="#" onClick="selectTest(this.id);">'
		.$testNames[$i].'</a></h2>';
    	echo '</li>';
	}
    ?>
    </ul>
  <input name="hid" type="hidden" id="hid" value="not_set"/>
  </form>
  </div>
</div>
<script>
function selectTest(selectedID){
	event.preventDefault();
	document.getElementById("hid").value = selectedID;
	document.getElementById("hid_form").submit();
	}
</script>
</body>
</html>
