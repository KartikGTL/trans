 <?php 
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB = "OnLineTest";
$conn = new COM ("ADODB.Connection");
$connStr = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
$conn->open($connStr);
?>

