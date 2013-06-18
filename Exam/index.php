<?php
session_start();
$role_check='20';
include('check/check.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery-1.5.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#login").click(function() {
	
		var action = $("#form1").attr('action');
		var form_data = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response)
			{
				if(response == 'success')
					$("#form1").slideUp('slow', function() {
						$("#message").html("<p class='success'>You have logged in successfully!</p>");
						setTimeout('go_to_private_page()', 2700);
					});
				else
					$("#message").html("<p class='error'>Invalid username and/or password.</p>");	
			}
		});
		
		return false;
	});
	
});
function go_to_private_page()
{
window.location = 'Admin/index.php'; // Members Area
}
</script>
<style>
body {
 background:url(Admin/ckeditor/abc.png);
  background-position: 50% -10%;
  background-repeat: no-repeat;
}
</style>
</head>

<body>
<p>&nbsp;</p>
<div id="content">
  
  <form id="form1" name="form1" action="doLogin.php" method="post">
   <center> <p>
     
      <input type="text" name="username" id="username" onblur="if (this.value == '') {this.value = 'UserName';}" onfocus="if (this.value == 'UserName') {this.value = '';}" value="UserName"  />
    </p>
    <p>
     
      <input type="password" name="password" id="password" onblur="if (this.value == '') {this.value = '***********';}" onfocus="if (this.value == '***********') {this.value = '';}" value="***********"/>
    </p>
    <p>
     <input type="submit" id="login" name="login" value='Login'/>
    </p></center>
  </form>
    <div id="message"></div>
</div>
</body>

</html>