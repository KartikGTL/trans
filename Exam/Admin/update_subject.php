<?php 
session_start();
if($_SESSION['username_training']=="") {
header('location:http://www.psit.in');
}
 
require_once('conn.php');


$n=$_POST['subject'];

ini_set('date.timezone', 'Asia/Calcutta');
$sql = "INSERT INTO M_Subject VALUES ('$n','".date("F j, Y, g:i a")."')";
$conn->execute($sql);
header('Location:Question_Bank.php');

?>
