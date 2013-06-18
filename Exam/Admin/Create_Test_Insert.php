<?php
include("conn.php");
$paper=$_POST['paper'];
$test_name=$_POST['test_name'];
$nq=$_POST['nq'];
$time=$_POST['time'];
$forC=$_POST['forC'];
$forIc=$_POST['forIc'];
$isShow=$_POST['isShow'];
if($isShow!=1)
{
$isShow=0;
}
ini_set('date.timezone', 'Asia/Calcutta');
echo $sql = "INSERT INTO M_Test VALUES ('$test_name','$paper','$nq','$time','$forC','$forIc','$isShow','".date("F j, Y, g:i a")."','0') ";
$conn->execute($sql);
header('Location:Create_Test.php?msg=Test Added Successfully !!');
 ?>


