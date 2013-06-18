<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include("conn.php");
$batch_id=$_POST['batch_id'];
$training_id=$_POST['training_id'];
$test_id=$_POST['test_id'];
$stid=$_POST['stid'];
$name=$_POST['name'];
$len=count($stid); 
for($i = 0; $i < $len; $i++)
{
$sql="insert into M_Assign_Test_Student values('$stid[$i]','$name[$i]','$test_id','$training_id','$batch_id','".date("F j, Y")."')"; 
$conn->execute($sql);
}
$sql="insert into M_Test_Assign values('$test_id','$batch_id','$training_id','$len','".date("F j, Y")."','0')"; 
$conn->execute($sql);
header("location:http://www.psit.in/psit/Exam/Admin/Assign_Test.php?msg=".$len." Students has been Assigned for Given Test");
die;
?>