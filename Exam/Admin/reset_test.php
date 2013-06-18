<?php 
session_start();
if($_SESSION['username_training']=="") {
header('location:http://www.psit.in');
}
 
require_once('conn.php');

$sid=$_GET['sid'];
$tid=$_GET['tid'];
$sql = "DELETE FROM M_AnswerByStudent WHERE Student_Id='".$sid."' AND Test_Id='".$tid."'";
$conn->execute($sql);
echo $sql = "DELETE FROM M_TestByStudent WHERE Student_Id='".$sid."' AND Test_Id='".$tid."'";
$conn->execute($sql);
header('Location:Assign_Test.php?msg='.$_GET['name'].' Test Has Been Reset Successfully');

?>
