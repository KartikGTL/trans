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


<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery.slidertron-0.1.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
 function valid()
                {
                
			mobile=document.getElementById("mobile").value;
			len=mobile.length;
                var ch = 'a';
				 var ch1 = '1';
			
				if(mobile==null||mobile=="")
                {
				document.getElementById("nitin").innerHTML="Please Input your mobile Number!!";
				
                return false;
                }
				
			 if (len!=10 )
                {
				document.getElementById("nitin").innerHTML="Mobile No. Not Valid !!";
               

					return false;
                }
                if (mobile==null )
                {
				document.getElementById("nitin").innerHTML="Please input Mobile No. !!";
               

					return false;
                }
				else
				{
				  
				
                
				
				 for(var i = 0; i <mobile.length; i++)
				 
	{   
	
	ch1 = mobile.charAt(i);
	
		if(!('0' <= ch1 && ch1 <= '9'))
	          {
			  document.getElementById("nitin").innerHTML="The Mobile No must contain only Numberic character. !!";
		
		
		return false;
	           }
	}
				
}

}
	
</script>
 


<style type="text/css">
<!--
.style5 {
	color: #333333;
	font-weight: bold;
	background-color: #FFFFFF;
	font-family: Verdana;
}
.style1 {
	color: #000000;
	font-weight: bold;
}


-->
</style>





</head>

<body>
  <form action="update_subject.php" method="post">
<table width="434">

  <tr>
    
   
  </tr> 
 
  <tr>
    <td width="145" height="56" align="center" valign="middle" class="style1">Subject Name</td>
    <td width="277">
      <input type="text" name="subject" id="subject" />    </td>
  </tr>
   
  <tr>
    <td height="57" colspan="2" align="center">
      <input name="Submit" type="submit" class="style5" value="Submit" onclick="return valid();" />    </td>
  </tr>
</table>
<center><div id="nitin"></div>
</center>
  </form>
</body>
</html>
