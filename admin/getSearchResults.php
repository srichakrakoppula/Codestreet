<?php
include '../db_initializer.php';
$searchColumn = $_POST['searchColumn'];
$searchKey = $_POST['searchKey'];

$report = array();

$query = "SELECT Name,Testname,QuestionTitle,UserSolution,Score,Time,Space FROM user_test_records_view WHERE {$searchColumn} LIKE '%$searchKey%'";
//echo $query;

$result = mysqli_query($connection,$query);
if(!$result){
    die("No data retrieved");
    exit;	
}
$count = 0;
while($row=mysqli_fetch_assoc($result)){    
    $report[$count]['name'] = $row['NAME'];
    $report[$count]['testname'] = $row['Testname'];
    $report[$count]['title'] = $row['QuestionTitle'];
    $report[$count]['usr_solution'] = $row['UserSolution'];
    $report[$count]['score'] = $row['Score'];
    $report[$count]['time'] = $row['TIME'];
    $report[$count]['space'] = $row['SPACE'].'KB';
    $count++;
}

echo json_encode($report);

