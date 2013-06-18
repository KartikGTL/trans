<?php 
require_once('conn.php');
$q_id=$_POST['q_id'];
$question=$_POST['question'];
ini_set('date.timezone', 'Asia/Calcutta');
$s_id=$_POST['s_id'];
$ans1=$_POST['answer1'];
$ans2=$_POST['answer2'];
$ans3=$_POST['answer3'];
$ans4=$_POST['answer4'];
$addedby='Prateek';
$IsCorrect=$_POST['IsCorrect'];
$sql ="delete from M_Answer WHERE Question_Id='$q_id' and Subject_Id='$s_id'";
$conn->execute($sql);
$sql ="UPDATE M_Question SET Question='$question',Date='".date("F j, Y, g:i a")."',AddedBy='$addedby'  WHERE Question_Id='$q_id' and Subject_Id='$s_id'";
$conn->execute($sql);
if($IsCorrect=='answer1'){
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans1','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans1','0') ";
$conn->execute($sql);
}


if($IsCorrect=='answer2'){
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans2','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans2','0') ";
$conn->execute($sql);
}
if($IsCorrect=='answer3'){
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans3','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans3','0') ";
$conn->execute($sql);
}
if($IsCorrect=='answer4'){
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans4','1') ";
$conn->execute($sql);
}
else
{
$sql = "INSERT INTO M_Answer VALUES ('$q_id','$s_id','$ans4','0') ";
$conn->execute($sql);
}
header('Location:View_Question.php?msg=Question Updated Successfull !!&s_id='.$s_id.'&q_id='.$q_id);
?>