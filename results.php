<?php
	include 'session_func.php';
	confirmLoggedIn();
	include 'db_initializer.php';
	//$query = "";
	$rank = 1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Result</title>
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
<script src="js/jquery-latest.min.js" type="text/javascript"></script>
</head>

<body>
<div id = "display_msg">
	<?php echo "You are #{$rank} on the list.";?>
  <p> Your Feedback is valuable to us.<br>
    Please provide your feedback <a href="#">here</a>.</p>
</div>
</body>
</html>