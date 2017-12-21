 <?php 
 include 'db_initializer.php';
// print_r($_POST);
// exit;
session_start();
$uid = $_SESSION['admin_id'];
if(isset($_POST['testid']))
	$testid = $_POST['testid'];
$code = $_POST['code'];
$bool_stdin = $_POST['checkstdin'];
$stdin = $_POST['stdin'];
$lang = $_POST['lang'];
$qid = 1;
if(isset($_POST['qid']))
	$qid = $_POST['qid'];

	
function generateRandomString($length=5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

////////////////////....Setting up a few things...../////////////////////////////////
$doe = "D:\\dir";	//Directory of Execution
if(!file_exists($doe)){
	if(!mkdir($doe)){
		echo "Couldn't create source directory";
		exit;	
	}
}
$doe = $doe.'\\';
$stdin_file_name = generateRandomString();

////////////////////......Create Program file....../////////////////////////////////
$name = generateRandomString();
$ext = ".".$lang;
$source_file = fopen($doe.$name.$ext, "w");
fwrite($source_file,$code);
fclose($source_file);
////////////////////........Compile Program......../////////////////////////////////
$compiler = $lang=="c"?"gcc":"g++";
$output_temp = array();
exec($compiler." -o ".$doe.$name.".o ".$doe.$name.$ext." 2>&1",$output_temp);
$output=null;
for($i=0;$i<sizeof($output_temp);$i++){
	$output.=$output_temp[$i]."\n";
}

echo $output;
if(file_exists($doe.$name.".o "))
	echo "Compilation Successful!\n";
else{
	echo "Compilation Failed!\n";
	unlink($doe.$name.$ext);
	exit;
}

////////////////////........Execute Program......../////////////////////////////////

//////////////////........Managing stdin........///////////////////////////////////
$stdin_file=0;
if($bool_stdin=='on'){
	$stdin_file = fopen($doe.$stdin_file_name.".tmp","w");
	fwrite($stdin_file,$stdin);
	fclose($stdin_file);

	exec($doe.$name.".o < ".$doe.$stdin_file_name.".tmp > ".$doe.$stdin_file_name.".out");
        
//echo $doe.$name.".o < ".$doe.$stdin_file_name.".tmp > ".$doe.$stdin_file_name.".out";
	
	$out_file = fopen($doe.$stdin_file_name.".out","r");
	$output = fread($out_file,filesize($doe.$stdin_file_name.".out"));
	fclose($out_file);
/*for($i=0;$i<sizeof($output_temp);$i++){
	$output.=$output_temp[$i]."\n";
}*/
	echo $output;
}else{
	$query = "SELECT inputstream,outputstream FROM testcases where tcid in (SELECT tcid FROM q2tcmap WHERE qid = ".$qid.")"; 
	$total_time = 0;
	for($j=0;$j<4;$j++){ 
		$result = mysqli_query($connection,$query);
		$num_rows = mysqli_num_rows($result);
		$i=0;
		$increment = 100/$num_rows;
		$score = 0;
		$time = 0;
		while(($row=mysqli_fetch_assoc($result))){
			$stdin = $row['inputstream'];
			$stdout = $row['outputstream'];
			$stdin_file = fopen($doe.$stdin_file_name.".tmp","w");
			fwrite($stdin_file,$stdin);
			fclose($stdin_file);
			$starttime = microtime(true);
			$descriptors = array(
			  0 => array("file", $doe.$stdin_file_name.".tmp", 'r'),
			  1 => array("file", $doe.$stdin_file_name.".out", 'w'),
			  2 => array("file", $doe.$stdin_file_name.".err", 'w')
			);
			$command = $doe.$name.".o";
			//exec($doe.$name.".o < ".$doe.$stdin_file_name.".tmp > ".$doe.$stdin_file_name.".out");
			$process = proc_open($command, $descriptors, $pipes);
			$wait_count = 0;
			do{
				$status = proc_get_status($process);	
				usleep(200000);
				$wait_count++;
			}while($status['running']===true&&$wait_count<15);
			proc_terminate($process);
			$endtime = microtime(true);
			$time+=($endtime-$starttime);
			$output = file_get_contents($doe.$stdin_file_name.".out");
			$stdout = trim($stdout);
			$output = trim($output);
			//echo $stdout."\n".$output."\n";
			if($stdout == $output){
				$score+=$increment;	
			}
		}
		if($j!=0)
			$total_time += $time; 
	}
	$total_time = number_format($total_time,2);
	$avg_time = $total_time/3;
	$avg_time = number_format($avg_time,2);
	
	$size = filesize($doe.$name.".o");
	$size /= 1024;
	$size = round($size);
	$query = "INSERT into user_test_records(uid,testid,qid,usr_solution,score,time,space)
			 values('{$uid}',".$testid.",".$qid.",'".mysqli_real_escape_string($connection,$code)."',".$score.",'{$avg_time}secs',".$size.")";
	//echo "\n".$query;
	$result = mysqli_query($connection,$query);
	if(!$result)
		echo "\nResubmission is not allowed";
	echo "\nYour Score: ".$score;
	echo "\nTime: ".$avg_time."secs";
	echo "\nSpace: ".$size."KB";
}


if(file_exists($doe.$name.$ext))
	unlink($doe.$name.$ext);
if(file_exists($doe.$name.".o"))
	unlink($doe.$name.".o");
if(file_exists($doe.$stdin_file_name.".tmp"))
	unlink($doe.$stdin_file_name.".tmp");
if(file_exists($doe.$stdin_file_name.".out"))
	unlink($doe.$stdin_file_name.".out");
if(file_exists($doe.$stdin_file_name.".err"))
	unlink($doe.$stdin_file_name.".err");
//echo $compiler." -o ".$doe.$name.".o ".$doe.$name.$ext." 2>&1";
//echo $doe.$name.".o < ".$doe.$stdin_file_name;
?>