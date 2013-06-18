<?php
session_start();
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB = "OnLineTest";
$conn = new COM ("ADODB.Connection");
$connStr = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
$conn->open($connStr);
	$is_ajax = $_REQUEST['is_ajax'];
	if(isset($is_ajax) && $is_ajax)
	{
	$user_id = str_replace("'--","",$_REQUEST['username']);
$password = str_replace("'--","",$_REQUEST['password']);
$user_id = str_replace("'","",$_REQUEST['username']);
$password = str_replace("'","",$_REQUEST['password']);
$user_id = str_replace("--","",$_REQUEST['username']);
$password = str_replace("--","",$_REQUEST['password']);
$user_id = str_replace("'or''='","",$_REQUEST['username']);
$password = str_replace("'or''='","",$_REQUEST['password']);

$user_id = str_replace("' or 1=1--","",$_REQUEST['username']);
$password = str_replace("' or 1=1--","",$_REQUEST['password']);
$user_id = str_replace("' union select 1, 'fictional_user', 'some_password', 1--","",$_REQUEST['username']);
$password = str_replace("' union select 1, 'fictional_user', 'some_password', 1--","",$_REQUEST['password']);
	
	 $sql="SELECT * FROM M_Admin
	  WHERE username='$user_id' AND password='$password' ";
$rs = $conn->execute($sql);
$c_uname = $rs->fields('username');
$name = $rs->fields('Name');
$c_pass = $rs->fields('password');

		if($user_id ==$c_uname && $password == $c_pass)
		{
		 $_SESSION['username_training']=$user_id;	
			echo "success";	
		}
	}
	
?>