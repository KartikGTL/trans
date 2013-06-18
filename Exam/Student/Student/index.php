<?php 
session_start();
if($_SESSION['username_stu']=="") {
header('location:http://www.psit.in');
}
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB = "eCollege";
$conn = new COM ("ADODB.Connection");
$connStr = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
$conn->open($connStr);
$sql="SELECT * FROM M_Student WHERE University_RollNo='".$_SESSION['username_stu']."'";
	$rs3 = $conn->execute($sql);
    $_SESSION['name']=(string)$rs3->fields('Student_Name');
	$_SESSION['student_id']=(string)$rs3->fields('Lib_code');
	header('location:home.php');
?>
