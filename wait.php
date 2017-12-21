<?php
include 'session_func.php';
confirmLoggedIn();
if(!isset($_GET['tid'])){
	header("Location: index.php");
}
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
$tot_time_in_secs = $start_date+($start_time-$cur_date)-$cur_time;
$time_to_begin = $start_date+($start_time-$cur_date)-$cur_time;
$wait = $tot_time_in_secs<=600&&$time_to_begin>0;
//echo $wait;
//exit;
if(!$wait)
	header("Location: tests.php");
$m = intval($tot_time_in_secs/60);
$s = $tot_time_in_secs%60;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Wait</title>
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
		The test will begin in <span id="time"></span>
   <p> 
  Please be patient.
  </p>
</div>
<form id="fid" method="post" action="questions.php">
<input name="hid" type="hidden" value="<?php echo $testid;?>">
<input id="submit" type="submit" name="submit" value="submit">
</form>
<script>
$(document).ready(function() {
	$("#fid").hide();
	var m = <?php echo $m;?>, s=<?php echo $s;?>;
	$('#time').html(m+'m '+s+'s');
	var interval = setInterval(function(){
		if(m==0&&s==0){
			$("#submit").click();
			remove_interval();
		}
		if(s==0){
			m--;
			s=59;	
		}
		s--;
		if(m==0&&s<=3){
			$('#display_msg').html("Good Luck!")
		}else
			$('#time').html(m+'m '+s+'s');
	},1000);

	function remove_interval(){
		clearInterval(interval);
	}
});


</script>
</body>
</html>