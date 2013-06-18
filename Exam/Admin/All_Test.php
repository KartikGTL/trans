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
			    <li><a href="Question_Bank.php" ><span>Question Bank</span></a></li>
			    <li><a href="Create_Test.php"><span>Create Test</span></a></li>
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
			<a href="#" class="close">close</a>	  </div>
		
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
						<h2 class="left">All Test</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="10%">Test Id </th>
								<th width="11%">Test Name </th>
								<th width="14%"> Subject Name </th>
								<th width="13%">No. of Question </th>
								<th width="11%">Time</th>
								<th width="11%">For Correct </th>
								<th width="11%">For InCorrect </th>
								<th width="9%">is Show </th>
								<th width="10%">Action</th>
							</tr>
							
							<?php 
	$str = "SELECT  * FROM  M_Test";
 		$rs= $conn->execute($str);
		while (!$rs->EOF)  
		{
							?>
							<tr>
								<td><h3><?php echo $rs->fields('Test_Id')?></h3></td>
								<td><?php echo $rs->fields('Test_Name')?></td>
								<td><?php $str = "SELECT * FROM M_Subject WHERE Subject_Id='".$rs->fields('Paper_Id')."'";
 		$rs1= $conn->execute($str); 
		echo $rs1->fields('Subject_Name');
		
		 ?> </td>
								<td><?php echo $rs->fields('NoQ')?></td>
								<td><?php echo $rs->fields('Time')?> Min.</td>
								<td><?php echo $rs->fields('M_C')?></td>
								<td><?php echo $rs->fields('M_IC')?></td>
								<td><?php if($rs->fields('isShow')==1){ echo 'YES';}else{ echo 'NO';}?></td>
								<td><a href="edit_Test.php?id=<?php echo $rs->fields('Test_Id')?>&subid=<?php echo $rs1->fields('Subject_Id')?>" class="add-button"><span>Edit</span></a></td>
							</tr>
							
							
						<?php 
						
						$rs->MoveNext();
						}?>
						</table>
						
						
						<!-- Pagging -->
						<div class="pagging"></div>
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