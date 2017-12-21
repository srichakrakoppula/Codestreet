<?php
if(!(isset($_POST['hid']))){
	header("Location: index.php");
}
$testid = $_POST['hid'];
include 'session_func.php';
confirmLoggedIn();
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
$time_to_begin = $start_date+($start_time-$cur_date)-$cur_time;
$wait = $time_to_begin<=600&&$time_to_begin>0;
$timeup = $cur_time - ($start_date+($start_time-$cur_date))>=$duration_secs;
//echo "l ".$longwait."w ".$wait."t ".$timeup;
//exit;
if($longwait){
	header("Location: timemismatch.php?time=less&tid={$testid}");
}
else if($wait){
	header("Location: wait.php?tid={$testid}");
}else if($timeup){
	header("Location: timemismatch.php?time=more&tid={$testid}");
}
$end_time = ($start_date+($start_time-$cur_date))+$duration_secs;
$time_left = $end_time-$cur_time;
$tl_m = intval($time_left/60);
$tl_s = $time_left%60;
//////////Fetching no of questions/////////////////
$query = "SELECT no_of_ques FROM tests WHERE testid={$testid}";
$no_of_ques = 0;
if($result=mysqli_query($connection,$query)){
	if($row = mysqli_fetch_assoc($result)){
		$no_of_ques = $row['no_of_ques'];
	}else{
		die("Couldn't connect to db");
		exit;
	}
}else{
	die("Couldn't connect to db");
	exit;
}
///////////////Fetching titles and other details///////////////
$qid = array();$title = array(); $question = array(); $input_desc = array(); 
$output_desc = array(); $constraints = array(); $ex_input = array();$ex_output = array();
$query = "SELECT qid,title,question,input_desc,output_desc,constraints,ex_input,ex_output FROM questions WHERE qid IN (SELECT qid FROM t2qmap WHERE testid={$testid})";
if($result = mysqli_query($connection,$query)){
	$i=1;
	while($row = mysqli_fetch_assoc($result)){
		$qid[$i] = $row['qid'];
		$title[$i] = htmlspecialchars($row['title']	);
		$question[$i] = nl2br(htmlspecialchars($row['question']));
		$input_desc[$i] = nl2br(htmlspecialchars($row['input_desc']));
		$output_desc[$i] = nl2br(htmlspecialchars($row['output_desc']));
		$constraints[$i] = nl2br(htmlspecialchars($row['constraints']));
		$ex_input[$i] = nl2br(htmlspecialchars($row['ex_input']));
		$ex_output[$i] = nl2br(htmlspecialchars($row['ex_output']));
		$i++;
	}
}else{
	die("Couldn't connect to db");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Questions</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
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
    </ul><br><br><br>
    <div id="time_container">Time left:&nbsp;<span id="time"></span></div>
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
  <input id="testid" type="hidden" value='<?php echo $testid; ?>'/>
  
  <div id="content">
    <div id="tab-container">
      <ul>
      	<?php
		for($i=1;$i<=$no_of_ques;$i++){	
        	echo '<li class="tablinks"><a id="tablink'.$i.'" href="#main-container" onClick="changeTab(this)">'.$title[$i].'</a></li>';
		}
		?>
      </ul>
    </div>
    <div id="main-container"> Click on the tabs to the left. </div>
  </div>
</div>

<?php 
	for($i=1;$i<=$no_of_ques;$i++){
		echo "<div class='tabs' id='tab".$i."'>";
		echo "<h1 id='title'>".$title[$i]."</h1>";
		echo "<p id='que'>".$question[$i]."</p>";
		echo "<p id='input'><h1 class='inner_title'>
		<strong>Input</strong></h1>".$input_desc[$i]."</p>";
		echo "<p id='output'><h1 class='inner_title'>
		<strong>Output</strong></h1>".$output_desc[$i]."</p>";
		echo "<p id='constraints'>
        <h1 class='inner_title'><strong>Constraints</strong></h1>
        <ul type='disc'><li>".$constraints[$i]."</li></ul></p>";
		echo '<p id="example">
        <h1 class="inner_title"><strong>Example</strong></h1>
        <h3 class="titles_inside_example">Input:</h3>
        <p>'.$ex_input[$i].'</p><h3 class="titles_inside_example">Output:</h3>
        <p>'.$ex_output[$i].'</p></p>';
		echo '<!--Compiler area begin-->
        <div id="comp_area">
          <form id="testForm">
          	<input id="qid" name="qid" type="hidden" value="'.$qid[$i].'"/>
            <pre id="solution"></pre>
            <textarea id="stdin"  placeholder="Enter your input here.." ></textarea>
            <textarea id="error_msg"  placeholder="Server messages here.." ></textarea>
            <select id="lang">
              <option value="c">C</option>
              <option value="cpp">C++</option>
            </select>
            <input id="bool_stdin" type="checkbox" onclick="check()" value="stdin"/>
            <input id="checkstdin" type="hidden" value="on"/>
            <span id="bool_stdin_label">stdin</span>
            <input id="submit" type="submit" onclick="compile()" value="Compile&Run"/>
            <input id="submitnsave" type="submit" onClick="sub_n_compile()" value="Submit">
          </form>
        </div>
        <!--Compiler area ends here--> 
      </div>
      <!-- Tab '.$i.' ends here-->';
	}
	echo '<!-- Tabs End -->';
?>

<script> 

$(document).ready(function () {
	$('.tabs').hide();
	$('#tablink1').click();
   var location = window.location;
   var found = false;
   $("#tab-container a").each(function(){
      var href = $(this).attr("href");
      if(href==location){
         $(this).parent().addClass("selected");
         found = true;
      }
   });
   if(!found){
      $("#tab-container li:first").addClass("selected");
   }
   /////////////Timer Logic//////////////
	var m = <?php echo $tl_m;?>, s=<?php echo $tl_s;?>;
	$('#time').html(m+'m '+s+'s');
	var interval = setInterval(function(){
		if(m==0&&s==0){
			remove_interval();
			window.location.replace("thankyou.html");
		}
		if(s==0){
			m--;
			s=59;
			s++;	
		}
		s--;
		$('#time').html(m+'m '+s+'s');
	},1000);

	function remove_interval(){
		clearInterval(interval);
	}
   
});


var editor = null;
function changeTab(ele){
	var tab_id = $(ele).attr('id');
	var txt;
	$('#main-container').html(txt);
	$('.tablinks').removeClass('selected');
	switch(tab_id){
		case 'tablink1':
			txt = $('#tab1').html();
			$(ele).parent().addClass("selected");
			break;
		case 'tablink2':
			txt = $('#tab2').html();
			$(ele).parent().addClass("selected");
			break;
		case 'tablink3':
			txt = $('#tab3').html();
			$(ele).parent().addClass("selected");		
			break;
		case 'tablink4':
			txt = $('#tab4').html();
			$(ele).parent().addClass("selected");
			break;
		default:
			alert("Default case");
	}
	$('#main-container').html(txt);
	$('#bool_stdin').prop('checked', true);
	check();
	$('#bool_stdin').hide();
	$('#bool_stdin_label').hide();
	editor = ace.edit("solution");
    editor.setTheme("ace/theme/chrome");
    editor.session.setMode("ace/mode/c_cpp");
	editor.getSession().setUseWrapMode(true);
}
</script>
<script type="text/javascript">
function compile(){
	event.preventDefault();
	$('#checkstdin').val("on");
	if($('#stdin').val()==""){
		alert("Please enter your input.");
		return;
	}
	$('#error_msg').val("Compiling...\nPlease wait..");	
	compileCode();
}
function sub_n_compile(){
	event.preventDefault();
	$('#bool_stdin').prop('checked',false);
	$('#checkstdin').val("off");
	$('#error_msg').val("Running backgroud testcase drivers...\nPlease wait..");
	compileCode();
}

function compileCode(){
	  $.post("compiler_set.php",{testid: $('#testid').val() ,code: editor.getValue(), checkstdin: $('#checkstdin').val(), stdin: $('#stdin').val(), lang: $('#lang :selected').val(), qid: $('#qid').val() } , function(data)
		{	
			$('#error_msg').val($.trim(data));
		});
}

</script>
<script>
    
</script>
</body>
</html>