<?php 
session_start();
if($_SESSION['username_training']=="") {
header('location:http://www.psit.in');
}
 
require_once('conn.php'); 
$id=$_GET['id'];
$v=$_GET['v'];
$sql = "UPDATE M_Test_Assign SET isActive='".$v."' WHERE Id='".$id."'";
$conn->execute($sql);
header('Location:Assign_Test.php');

?>
