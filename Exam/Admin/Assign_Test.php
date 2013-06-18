<?php 
session_start();
if($_SESSION['username_training']=="") {
header('location:http://www.psit.in');
}
 
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB1 = "CollegeMaster12";
$conn1 = new COM ("ADODB.Connection");
$connStr1 = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB1; 
$conn1->open($connStr1);

$stmisc = new Misc();
   class Misc 
{
	
	function getTestName($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE  Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Test_Name');
    return $no; 
    }
	function getisStrat($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE  Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('isStart');
    return $no; 
    }
	function getBatch($conn,$bid)
	{
  $sql="SELECT DISTINCT SectionName  FROM TrainingStudentMap WHERE SectionId='".$bid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('SectionName');
    return $no; 
    }
	function getTraining($conn,$tid)
	{
  $sql="SELECT * FROM M_Traning WHERE Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('TraningName');
    return $no; 
    }
	
}
	
?>
<?php 
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
	<script src="facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facefiles/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
<style type="text/css">
<!--
.style2 {font-size: 16}
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
			    <li><a href="Create_Test.php"><span>Create Test</span></a></li>
			    <li><a href="All_Test.php" ><span>All Test</span></a></li>
			    <li><a href="Assign_Test.php" class="active"><span>Assign Test</span></a></li>
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
			<a href="#" class="close">close</a>
	  </div>
		
		<?php }?>
			
			<a href="add_new_assignment.php" class="add-button"><span>Add New Assignment</span></a>
		<br /><br />
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
						<h2 class="left">Assign Test</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="144">Test Id</th>
								<th width="237">Test Name</th>
								<th width="261">Training Name</th>
								<th width="265">Branch Assigned</th>
								<th width="185">Date</th>
								<th width="139" class="ac">Action</th>
							</tr>
							
							<?php 
	  $str = "SELECT  * FROM  M_Test_Assign " ;
 		$rs= $conn->execute($str);
	
		$i=0;
		while (!$rs->EOF)  
		{
	 $bgcol = ($i%2==0?"#DFFFFF":""); 


?>
							<tr bgcolor="<?php echo $bgcol; ?>">
								<td><span class="style2"><?php echo $rs->fields('Test_Id')?></span></td>
								<td><span class="style2"><?php echo $stmisc->getTestName($conn,$rs->fields('Test_Id')) ?></span></td>
								<td><span class="style2"><?php echo $stmisc->getTraining($conn1,$rs->fields('Training_Id')) ?></span></td>
								<td><a href="view_student.php?id=<?php echo $rs->fields('Batch_Id');?>&tid=<?php echo $rs->fields('Test_Id')?>" class="style2"  rel="facebox"><?php echo $stmisc->getBatch($conn1,$rs->fields('Batch_Id')) ?> [ <?php echo $rs->fields('No_Student')?> ]</a></td>
								<td><span class="style2"><?php echo $rs->fields('Date')?></span></td>
								<td><span class="style2">
							    <?php  if($rs->fields('isActive')==1){ ?>
							   <a href="update_test.php?id=<?php echo $rs->fields('Id');?>&v=0"> <img src="stop.png" /></a> 
							    <?php }else{?>
							    <a href="update_test.php?id=<?php echo $rs->fields('Id');?>&v=1">  <img src="start.png" /> </a>
							    <?php }?>
								</span></td>
							</tr>
							<?php 
						$i++;
						$rs->MoveNext();
						}?>
						</table>
						</div>
						
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