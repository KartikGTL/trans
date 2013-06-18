<?php
require_once('conn.php');
 
$a=$_POST['nq'];
$b=$_POST['time'];
$c=$_POST['forC'];
$d=$_POST['forIc'];
$e=$_POST['isShow'];
$f=$_POST['testid'];
if(isSET($_POST['isShow']))
{
$e=1;
}
else{
$e=0;

}

ini_set('date.timezone', 'Asia/Calcutta');
echo $sql1 = "UPDATE  M_Test SET NoQ='$a', TIME='$b' , M_C='$c' , M_IC='$d' , isShow='$e' , Date='".date("F j, Y, g:i a")."' WHERE Test_Id='$f'";
$conn->execute($sql1);
header('Location:All_Test.php');

?>


