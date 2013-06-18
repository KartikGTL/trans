<?php
try{
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB = "eCollege";
$conn = new COM ("ADODB.Connection");
$connStr = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
$conn->open($connStr);
$role=$role_check;
$uid=$_SESSION['userid'];
 $sql="SELECT count(*) as valid FROM M_User_Role WHERE userid='".$uid."' AND role='".$role."'";

 $rs3 = $conn->execute($sql);

 $valid =(string)$rs3->fields('valid');
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
if((string)$rs3->fields('valid')=="0")
{
	header('location:http://www.psit.in');
}
?>