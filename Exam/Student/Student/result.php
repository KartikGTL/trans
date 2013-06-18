<?php 
session_start();
if($_SESSION['username_stu']=="" || $_SESSION['isAllow']==0) {
header('location:http://www.psit.in');
}
require_once('conn.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Exam</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
	<style>
#txt {
border:2px solid red;
font-family:verdana;
font-size:16pt;
font-weight:bold;
background: #FECFC7;
width:70px;
text-align:center;
color:#000000;


}

    </style>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><img src="../logo.png" /></h1>
			<div id="top-navigation">
			  <table width="316" height="72" border="0">
                <tr>
                  <td width="111" align="left"><font face="Verdana" size="2">Student Name :</font></td>
                  <td width="133" align="left"><font face="Verdana" size="2"><?php echo $_SESSION['name']?></font></td>
                </tr>
                <tr>
                  <td align="left"><font face="Verdana" size="2">Test Name :</font></td>
                  <td align="left" ><font face="Verdana" size="2"><?php echo $_SESSION['Test_Name'];?></font></td>
                </tr>
               
              </table>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		
		<!-- End Small Nav -->
		
		<!-- Message OK -->		
		  <span id="searchresult">
		  
		  


			
		
		
	
        <br />
	<?php
 $sql1="SELECT * FROM M_Test WHERE Test_Id='".$_SESSION['Test_Id']."'";
 $rs4 = $conn->execute($sql1);
 $Test_Name=$rs4->fields('Test_Name');
 $M_C=$rs4->fields('M_C');
 $M_IC=$rs4->fields('M_IC');
 $isShow=$rs4->fields('isShow');
 $Marks=0;
 $isCorrect=0;
 $isNotCorrect=0;
 $isAttempt=0;
 
	for ($i = 0; $i<$_SESSION['TnQ'] ; $i++)
	 {
	 
	   if($_SESSION['CA'][$i]==1)
	   {
	   $isCorrect=$isCorrect+1;
	   }
	   else if($_SESSION['CA'][$i]==-1)
	   {
	   $isNotCorrect=$isNotCorrect+1;
	   } 
	   if($_SESSION['TA'][$i]==1)
	   {
	  $isAttempt=$isAttempt+1;
	   }
	 }

 $Marks=$isCorrect*$M_C-$isNotCorrect*$M_IC;
 
ini_set('date.timezone', 'Asia/Calcutta');
$date=date("F j, Y, g:i:s a");
$str3 = "UPDATE M_TestByStudent SET End_Time='".$date."',A_Correct='".$isCorrect."',A_InCorrect='".$isNotCorrect."',Marks='".$Marks."',isCompleted='1' WHERE Student_Id='".$_SESSION['student_id']."' AND Test_Id='".$_SESSION['Test_Id']."' " ;
$conn->execute($str3);
?>
<div id="main">
<div id="content">
<div class="box">
<div class="box-head">
<h2 class="left">Result
</h2>
</div>

<div class="table">
<table width="983" height="267" border="0" align="center">
<tr>
<td height="203" colspan="2">
<center> <form name="orderform" method="post" action="home.php">

<?php if( $isShow==1){?>
<table width="431" border="0" align="center">
<tr>
<td width="242" align="left"><strong></strong></td>
<td width="179" align="center"><strong></strong></td>
</tr>
<tr>
<td width="242" align="left"><strong>Total Attempt Question</strong></td>
<td width="179" align="center"><strong> <?php echo $isAttempt; ?></strong></td>
</tr>
<tr>
<td width="242" align="left"><strong>Total Correct Answer</strong></td>
<td width="179" align="center"><strong><?php echo $isCorrect; ?></strong></td>
</tr>
<tr>
<td width="242" align="left"><strong>Total InCorrect Answer</strong></td>
<td width="179" align="center"><strong><?php echo $isNotCorrect; ?></strong></td>
</tr>
<tr>
<td width="242" align="left"><strong>Total Marks</strong></td>
<td width="179" align="center"><strong><?php echo $Marks; ?></strong></td>
</tr>
</table>
 <?php }else {?>
 <center><br /><br /><br />
   <strong><h2>Your Test has been Successfully Submitted !!
   <br /><br />
 Thank You !   </h2></strong>
 </center>
 
 
 <br /><br />
 <?php }?>
<center><input name="Submit" type="submit" class="box-head" value="  OK  "  /></center>
</form>
</center>

</td></tr>
<tr>
<td width="463" align="left">
</td>

<td width="510" align="right">



</td>
</tr>
</table>


</div>
</div>
</div>
<div class="cl">&nbsp;</div>			
</div>


		<!-- Main -->
	</div>
</div>
<!-- End Container -->
</span>
<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2012 - Pranveer Singh Institute Of Technology</span>
		<span class="right">
			Design by - PSIT Software Developer</a>
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>
<?php 
$_SESSION['time']='';
$test_id="'".$_SESSION['time']."'";
$_SESSION[$test_id]='';
$_SESSION['isAllow']='0';
$_SESSION['CA']='';  
$_SESSION['Q']='';
$_SESSION['Qn']='';
$_SESSION['TnQ']=''; 
$_SESSION['TA']= '';
$_SESSION['A_BY_S']='';
$_SESSION['Subject_Id']='';
$_SESSION['Test_Name']='';
$_SESSION['Test_Id']='';
$_SESSION['isShow']='';
?>