<?php
if(!(isset($_POST['hid']))){
	header("Location: index.php");
}
$testid = $_POST['hid'];
 include 'session_func.php';
 confirmLoggedIn();
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
  <input id="testid" type="hidden" value='<?php echo $testid; ?>'/>
  <div id="content">
    <div id="tab-container">
      <ul>
        <li class="tablinks"><a id='tablink1' href="#main-container" onClick="changeTab(this)">Mahasena</a></li>
        <li class="tablinks"><a id='tablink2' href="#main-container" onClick="changeTab(this)">Question title 2</a></li>
        <li class="tablinks"><a id='tablink3' href="#main-container" onClick="changeTab(this)">Question title 3</a></li>
        <li class="tablinks"><a id='tablink4' href="#main-container" onClick="changeTab(this)">Question title 4</a></li>
      </ul>
       
    </div>
    <div id="main-container"> Click on the tabs to the left. </div>
  </div>
</div>



<div class='tabs' id="tab1">
        <h1 id='title'>Mahasena</h1>
        <p id='que'>Kattapa, as you all know was one of the greatest warriors of his time. The kingdom of Maahishmati had never lost a battle under him (as army-chief), and the reason for that was their really powerful army, also called as Mahasena.
          Kattapa was known to be a very superstitious person. He believed that a soldier is "lucky" if the soldier is holding an even number of weapons, and "unlucky" otherwise. He considered the army as "READY FOR BATTLE" if the count of "lucky" soldiers is strictly greater than the count of "unlucky" soldiers, and "NOT READY" otherwise.
          Given the number of weapons each soldier is holding, your task is to determine whether the army formed by all these soldiers is "READY FOR BATTLE" or "NOT READY".</p>
        <p id='input'>
        <h1 class="inner_title"><strong>Input</strong></h1>
        The first line of input consists of a single integer N denoting the number of soldiers. The second line of input consists of N space separated integers A1, A2, ..., AN, where Ai denotes the number of weapons that the ith soldier is holding.
        </p>
        <p id="output">
        <h1 class="inner_title"><strong>Output</strong></h1>
        Generate one line output saying "READY FOR BATTLE", if the army satisfies the conditions that Kattapa requires or "NOT READY" otherwise (quotes for clarity).
        </p>
        <p id='constraints'>
        <h1 class="inner_title"><strong>Constraints</strong></h1>
        <ul type="disc">
          <li>1 &le; N &le; 100</li>
          <li>1 &le; Ai &le; 100</li>
        </ul>
        </p>
        <p id="example">
        <h1 class="inner_title"><strong>Example</strong></h1>
        <h3 class="titles_inside_example">Input:</h3>
        <p> 1<br>
          1<br>
        </p>
        <h3 class="titles_inside_example">Output:</h3>
        <p>NOT READY</p>
        </p>
        
        <!--Compiler area begin-->
        <div id="comp_area">
          <form id="testForm">
          	<input id="qid" name="qid" type="hidden" value="123"/>
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
      <!-- Tab 1 ends here-->
      <div class='tabs' id="tab2">Tab 2 content here</div>
      <div class='tabs' id="tab3">Tab 3 content here</div>
      <div class='tabs' id="tab4">Tab 4 content here</div>
      <!-- Tabs End -->
      
     
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