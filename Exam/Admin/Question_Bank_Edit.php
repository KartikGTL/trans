<?php 
session_start();
if($_SESSION['username']=="") {
header('location:http://www.psit.in');
}

?>
<?php 
require_once('conn.php');

$q_id=$_GET['q_id'];
$s_id=$_GET['s_id'];


	 $str = "SELECT  * FROM  V_Question_Answer where Subject_Id=".$s_id." and Question_Id=".$q_id ;
 		$rs= $conn->execute($str);
		
		 $q_id_db=$rs->fields('Question_Id');
		 $q_db=$rs->fields('Question');
			 				
							
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
.style1 {
	color: #990000;
	font-weight: bold;
}
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
			    <li><a href="Question_Bank.php" class="active"><span>Question Bank</span></a></li>
			    <li><a href="Create_Test.php"><span>Create Test</span></a></li>
			    <li><a href="All_Test.php"><span>All Test</span></a></li>
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
		<div class="small-nav"><font size="+2"></font></div>
		<!-- End Small Nav -->
		
		<!-- Message OK --><!-- End Message OK -->		
		
		<!-- Message Error -->
		<!-- End Message Error -->
        <br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<!-- End Box -->
                <!-- Box -->
<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Add New Question</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="Question_Bank_Update.php" method="post">
					<input type="hidden" name="q_id" value="<?php echo $q_id; ?>"/>
					<input type="hidden" name="s_id" value="<?php echo $s_id; ?>"/>
						<!-- Form -->
						<div class="form">
						  <p>
									<span class="req">max 100 symbols</span>
									<label>Question  <span>(Required Field)</span></label>
										<textarea class="ckeditor" cols="80" id="editor1" name="question" rows="10" ><?php echo $q_db;?></textarea>
						  </p>	
							<center><table width="308" border="1" align="center" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="154" align="center"><span class="style1">Option's</span></td>
    <td width="144" align="center"><span class="style1">Correct Answer </span></td>
	
	
  </tr>
  
  <?php 
  $option=array();
	 $str = "SELECT  * FROM  V_Question_Answer where Subject_Id=".$s_id." and Question_Id=".$q_id ;
 		$rs= $conn->execute($str);
		$i=1;
		while (!$rs->EOF)  
		{
				 
				 				
				?>			
							
							
						
  <tr>
    <td><input name="answer<?php echo $i?>" type="text" size="25" maxlength="50" value="<?php echo $rs->fields('Answer_Text');?>" /></td>
    <td align="center"><input name="IsCorrect" type="radio" value="answer<?php echo $i?>" <?php if($rs->fields('IsCorrect')=='1'){?> checked="checked" <?php }?> /></td>
  </tr>
  
  
  
  <?php 
  $i++;
						$rs->MoveNext();
						}
						
  
  ?>
  
  
 
</table>
							</center>

					  </div>
						<!-- End Form -->
						
						<!-- Form Buttons -->
						<div class="buttons">
						<center>  <input type="submit" class="button" value="Update" />
						</center>
					  </div>
						<!-- End Form Buttons -->
					</form>
			  </div>
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