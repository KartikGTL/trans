<?php 
session_start();
if($_SESSION['username_training']=="") {
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
    <style type="text/css">
<!--
.style3 {font-size: 16px}
-->
    </style>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">PSIT Online Test</a></h1>
			<div id="top-navigation">
				Welcome <a href="#"><strong><?php echo $_SESSION['username']?></strong></a>
				<span>|</span>
				<a href="logout.php">Log out</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="index.php"><span>Home</span></a></li>
			    <li><a href="Question_Bank.php"><span>Question Bank</span></a></li>
			    <li><a href="Create_Test.php" ><span>Create Test</span></a></li>
			    <li><a href="All_Test.php" class="active"><span>All Test</span></a></li>
			    <li><a href="Assign_Test.php"><span>Assign Test</span></a></li>
			    <li><a href="Result.php"><span>Results</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav"></div>
		<!-- End Small Nav -->
		
		<!-- Message OK -->		
		<?php if($_GET['msg']!=''){?>
		
	  <div class="msg msg-ok">
			<p><strong><?php echo $_GET['msg']?></strong></p>
	  <a href="#" class="close">close</a></div>
		
		<?php }?>
		<!-- End Message OK -->		
		
		<!-- Message Error -->
		<!-- End Message Error -->
        <br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Create Test</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<?php
include("conn.php");

 $sql = "SELECT * FROM M_Test WHERE Test_id='".$_GET['id']."'";

$rs1 = $conn->execute($sql);
 
		 $a=$rs1->fields('Test_Name');
		 $b=$rs1->fields('Paper_Id');  
		 $c=$rs1->fields('NoQ'); 
		$d=$rs1->fields('Time'); 
		 	$a1=$rs1->fields('M_C'); 
			$b1=$rs1->fields('M_IC');
			$c1=$rs1->fields('isShow');
		 ?>
		 
		 
		 
		 
					<div class="table">
					
						<center> 
						   <form id="form2" name="form2" method="POST" action="edit_test_update.php">
						  <input type="hidden" value="<?php echo $_GET['id'];?>" name="testid" />
						   <input type="hidden" value="<?php echo $b;?>" name="paperid" />
						  <table width="752" border="0" align="center" cellspacing="0" bordercolor="#FBFCFC">
						 <tr>
    <td width="243" height="49"><span class="style3">Test Name</span> </td>
    <td width="505">
      <label>
	 
        <input name="test_name" type="text" id="test_name" size="50" maxlength="50" value="<?php echo $a; ?>"  disabled="disabled"/>
        </label>    </td>
  </tr>
						  
 
   
   <tr>
    <td width="243" height="49"><span class="style3">No. of Question</span> </td>
    <td width="505">
	<?php  $str = "SELECT COUNT(*) as no FROM M_Question WHERE Subject_Id='".$_GET['subid']."'";
 		$rs= $conn->execute($str); 
		
		 ?>
      <label>
        <input name="nq" type="text" id="nq" size="10" maxlength="10" onblur="if(this.value><?php echo $rs->fields('no');?>){alert('Sorry !! Please Enter Valid Number (Value Should be Less Then <?php echo $rs->fields('no');?> )'); this.value='';}" value="<?php echo $c; ?>" /><font face="Verdana" size="+1" color="#FF0000"> of <?php echo $rs->fields('no');?> </font>
        </label>    </td>
  </tr>
   <tr>
    <td width="243" height="49"><span class="style3">Time Duration</span> </td>
    <td width="505">
      <label>
	  
        <select name="time" id="time">
	
                         
						   <option value="10" <?php if($d==10) echo 'selected';?>>-- 10 MINUTE --</option>
                             <option value="20" <?php if($d==20) echo 'selected';?>>-- 20 MINUTE --</option> 
							   <option value="30" <?php if($d==30) echo 'selected';?>>-- 30 MINUTE --</option>   
                    </select>
        </label>
   
    </td>
  </tr>
    <tr>
	 <tr>
    <td width="243" height="49"><span class="style3">Marks (for Correct)</span> </td>
    <td width="505">
      <label>
        <input name="forC" type="text" id="forC" size="10" maxlength="50" value="<?php echo $a1; ?>" />
        </label></td>
  </tr>
    <tr>
	 <tr>
    <td width="243" height="49"><span class="style3">Marks (for InCorrect)</span> </td>
    <td width="505">
      <label>
        <input name="forIc" type="text" id="forIc" size="10" maxlength="50" value="<?php echo $b1; ?>" />
        </label></td>
  </tr>
    <tr>
    <td width="243" height="49"><span class="style3">Result Show </span> </td>
    <td width="505">
      <label>
	  
      <input name="isShow" type="checkbox" id="isShow"  <?php if($c1==1){ echo 'checked';}?>/>
      </label>    </td>
  </tr>
  <tr>
    <td colspan="2">
	
	<center>  <input type="submit" class="button" value="submit" /></center>  </td>
  </tr> </form>
</table>
						</center>

						
						<!-- Pagging -->
						
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
					
				</div>
				<!-- End Box -->
				
				<!-- Box -->
				<!-- End Box -->
            </div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<!-- End Sidebar -->
<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
  <?php include("footer.php"); ?>
<!-- End Footer -->
	
</body>
</html>