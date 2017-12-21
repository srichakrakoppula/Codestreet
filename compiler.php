<?php
 include 'session_func.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:h="http://java.sun.com/jsf/html" 
xmlns:f="http://java.sun.com/jsf/core" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Online Compiler</title>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="css/lgn.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round|Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<script src="js/jquery-latest.min.js"></script>
<script src="js/lgn_script.js"></script>
<script src="js/script_online_compiler_specific.js"></script>
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
      <li><a class="thispage" href="compiler.php">Online Compiler</a></li>
      <li><a href="practice.php">Practice</a></li>
      <li><a href="tests.php">Assessment</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </div>
  <!--End of Header and Navigation bar(common to all pages)-->
  <!--IDE begin-->
  <div id="ide">
  <form id="testForm">
  <pre id="solution" ></pre>
  <textarea id="stdin"  placeholder="Enter your input here.." ></textarea>
  
  <textarea id="error_msg"  placeholder="Server messages here.." ></textarea>
  <select id="lang">
  <option value="c">C</option>
  <option value="cpp">C++</option>
  </select>
  <input id="bool_stdin" type="checkbox" onclick="check()"/>stdin 
  <input id="checkstdin" type="hidden" value="on"/>
  <input id="submit" type="submit" onclick="compile()" value="Compile&Run"/>
  
  </form>
  </div>
  <!--IDE end-->
  
  <!-- Login Overlay -->
  <div class="overlay" style="display: none;">
    <div class="login-wrapper">
      <div class="login-content" id="loginTarget"> <a class="close">x</a>
        <h3>Sign in</h3>
        <form method="post" onsubmit="return validate_lgn();" action="login.php" >
          <label for="username"> Username:
            <input type="text" name="username" id="username" placeholder="Enter your username"  required />
          </label>
          <input type="hidden" name="redirect_to" value="compiler.php"/>
          <p id="lgn_err_usrname" style="display:none;font-family:'Lucida Grande', Tahoma, Arial, Verdana, sans-serif; color:#CD1316; font-size:14px;">&nbsp;&nbsp;*Invalid username</p>
          <label for="password"> Password:
            <input type="password" name="password" id="password" placeholder="Enter your password" required />
          </label>
          <button type="submit">Sign in</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Login Overlay end -->
  
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#bool_stdin').prop('checked', true);
	check();
});
function compile(){
	event.preventDefault();
	$('#checkstdin').val("on");
	$('#error_msg').val("Compiling...\nPlease wait..");
	compileCode();
}

function compileCode(){
	  $.post("compiler_set.php",{code: editor.getValue(),checkstdin: $('#checkstdin').val(), stdin: $('#stdin').val(), lang: $('#lang :selected').val()} , function(data)
		{	
			$('#error_msg').val($.trim(data));
		});
}
</script>
<script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("solution");
    editor.setTheme("ace/theme/chrome");
    editor.session.setMode("ace/mode/c_cpp");
	editor.getSession().setUseWrapMode(true);
</script>
</body>
</html>
