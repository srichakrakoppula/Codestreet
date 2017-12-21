<?php
include 'session_func.php';
confirmLoggedIn();
if(!isset($_GET['time'])||!isset($_GET['tid'])){
	header("Location: index.php");
}
$time = $_GET['time'];
if($time!="less"&&$time!="more")
	header("Location: index.php");
$testid = $_GET['tid'];

include 'db_initializer.php';
//////////Checking if the test is active or not. 
///////////If active, check if it's expired
$query = "SELECT start_date, start_time, duration, active FROM tests WHERE testid={$testid}";
$start_date = 0; $start_time = 0; $duration = 0; $active = 0;
if($result=mysqli_query($connection,$query)){
	if($row = mysqli_fetch_assoc($result)){
		$start_date = $row['start_date'];
		$start_time = $row['start_time'];
		$duration = $row['duration'];
		$active = $row['active'];
	}else{
		die("Couldn't connect to db");
		exit;
	}
}else{
	die("Couldn't connect to db");
	exit;
}
if($active==0){
	header("Location: timemismatch.php?time=more&tid={$testid}");
}
date_default_timezone_set("Asia/Kolkata");
$duration_secs = $duration*60;
$start_date = strtotime($start_date);
$start_time = strtotime($start_time);
$cur_date = strtotime(date("Y-m-d"));
$cur_time = time();
$longwait = $start_date+($start_time-$cur_date)-$cur_time>600;
$timeup = $cur_time - ($start_date+($start_time-$cur_date))>=$duration_secs;

if(!$longwait&&!$timeup)
	header("Location: tests.php");
$date_time_str = date('Y-m-d H:i:sa',$start_date+($start_time-$cur_date));
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $time=="less"?"Longwait":"Expired" ?></title>
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
	<?php 
		if($time=="less")
			echo "The test you're looking for will start on {$date_time_str}.";
		else 
			echo "Sorry! The test you're looking for has EXPIRED.";
	?>
  <p> 
  <?php 
  	if($time=="less")
  		echo "Please come 10mins before the test begins.";
	else
		echo "You will be redirected to the tests page. Please choose another test."
  ?>
  </p>
</div>
<?php if($time=="more")
echo '<script>
$(document).ready(function() {
  setTimeout(
  function() 
  {
    window.location.replace("tests.php");
  }, 5000);
});
</script>';
?>
</body>
</html>