<?php 
session_start();
if($_SESSION['username_training']=="") {
header('location:http://www.psit.in');
}
 
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
<table width="540" height="55" border="1" align="center" cellspacing="0" bordercolor="#000000">
  <tr>
    <th width="64" height="23" bgcolor="#000000"><span class="style1">S.N.</span></th>
    <th width="135" bgcolor="#000000"><span class="style1">Student Id </span></th>
    <th width="208" bgcolor="#000000"><span class="style1">Student Name </span></th>
	 <th width="115" bgcolor="#000000"><span class="style1">Reset Test </span></th>
  </tr>
  <?php 
	  $str = "SELECT * FROM M_Assign_Test_Student WHERE Batch_Id='".$_GET['id']."'" ;
 		$rs= $conn->execute($str);
	$i=1;
		while (!$rs->EOF)  
		{ $bgcol = ($i%2==0?"#DFFFFF":""); 

?>

							
							<tr bgcolor="<?php echo $bgcol; ?>">
    <td align="center"><font face="Verdana" size="2" ><?php echo $i;?></font></td>
    <td align="center"><font face="Verdana" size="2" ><?php echo $rs->fields('Student_Id')?></font></td>
    <td><font face="Verdana" size="2" ><?php echo $rs->fields('Student_Name')?></font></td>
	<td align="center"><font face="Verdana" size="2" ><a href="reset_test.php?sid=<?php echo $rs->fields('Student_Id')?>&tid=<?php echo $_GET['tid'];?>&name=<?php echo $rs->fields('Student_Name')?>">Reset</a></font></td>
  </tr>
  <?php 
					$i++;	
						$rs->MoveNext();
						}?>
</table>
</body>
</html>
