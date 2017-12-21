<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Success</title>
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
<script src="../js/jquery-latest.min.js" type="text/javascript"></script>
</head>

<body>
<div id = "display_msg">
	<?php echo ucfirst($_GET['type']);?> successfully created!<br>
    <?php echo ucfirst($_GET['type']);?> id: <?php echo $_GET['id'];?>
  <p id = "thanks"> You will be redirected to the <?php echo $_GET['type'];?> creation page.<br>
    Please wait.</p>
</div>
<script>
$(document).ready(function() {
  setTimeout(
  function() 
  {
    window.location.replace("create_<?php echo $_GET['type']=='test'?'test':'que'; ?>s.html");
  }, 3000);
});
</script>
</body>
</html>
