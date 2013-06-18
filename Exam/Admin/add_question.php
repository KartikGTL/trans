<?php
session_start();
include("conn.php");
$question=$_POST['question'];
$ans1=$_POST['answer1'];
$ans2=$_POST['answer2'];
$ans3=$_POST['answer3'];
$ans4=$_POST['answer4'];
$IsCorrect=$_POST['IsCorrect'];
ini_set('date.timezone', 'Asia/Calcutta');
$addedby=$_SESSION['username_training'];
$subject_id=$_POST['subject_id'];
$sql="SELECT  MAX(Question_Id) as no FROM  M_Question where Subject_Id=$subject_id";
$rs= $conn->execute($sql);
$i=$rs->fields('no');
$fn=$i+1;
$sql = "INSERT INTO M_Question VALUES ('$fn','$subject_id','$question','".date("F j, Y, g:i a")."','$addedby') ";
$conn->execute($sql);
if($IsCorrect=='answer1'){
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans1','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans1','0') ";
$conn->execute($sql);
}
if($IsCorrect=='answer2'){
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans2','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans2','0') ";
$conn->execute($sql);
}
if($IsCorrect=='answer3'){
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans3','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans3','0') ";
$conn->execute($sql);
}
if($IsCorrect=='answer4'){
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans4','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$fn','$subject_id','$ans4','0') ";
$conn->execute($sql);
}
ob_start();
header('Location:Question_Bank.php?msg=Question Add Successfull !!');
?>