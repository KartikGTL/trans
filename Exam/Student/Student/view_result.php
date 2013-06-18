<?php 
session_start(); 
require_once('conn.php');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<center><font color="#990000" size="+2">:: Result ::</font></center> <br />
<?php

$str1 = "SELECT * FROM M_Test WHERE Test_Id='".$_GET['id']."'" ;
 		$rs1= $conn->execute($str1);
if($rs1->fields('isShow')==1){
$str = "SELECT * FROM V_All_Info WHERE Student_Id='".$_SESSION['student_id']."' AND Test_Id='".$_GET['id']."' AND isCompleted='1'" ;
 		$rs= $conn->execute($str);



?>


<table width="352" height="88" border="1" cellspacing="0" bordercolor="#000000">
<tr>
    <td width="179" height="26">Total Attempt</td>
    <td width="163" align="center"><?php echo $rs->fields('A_Correct')+$rs->fields('A_InCorrect') ?></td>
  </tr>
  <tr>
    <td width="179" height="26">Total Correct Answer </td>
    <td width="163" align="center"><?php echo $rs->fields('A_Correct') ?></td>
  </tr>
  <tr>
    <td height="31">Total InCorrect Answer </td>
    <td align="center"><?php echo $rs->fields('A_InCorrect') ?></td>
  </tr>
  <tr>
    <td height="29">Total Marks </td>
    <td align="center"><?php echo $rs->fields('Marks') ?></td>
  </tr>
</table>

<?php }else{
?>

<hr /><br /><br />
<center><font color="#990000" size="+2">Locked</font></center><br /><br />
<hr />
<?php 

}

?>
</body>
</html>
