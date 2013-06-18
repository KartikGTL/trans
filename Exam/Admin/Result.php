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
	function getR($conn,$tid,$bid)
	{
  $sql="SELECT count(*) as no FROM V_All_Info WHERE isCompleted='0' AND Test_Id='".$tid."' and Batch_Id='".$bid."' ";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('no');
    return $no; 
    }
	
	function getF($conn,$tid,$bid)
	{
  $sql="SELECT count(*) as no FROM V_All_Info WHERE isCompleted='1' AND Test_Id='".$tid."' and Batch_Id='".$bid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('no');
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
			    <li><a href="Assign_Test.php" ><span>Assign Test</span></a></li>
			    <li><a href="Result.php" class="active"><span>Results</span></a></li>
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
						<h2 class="left">Results</h2>
					    <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="104" align="left">Test Id</th>
								<th width="154" align="left">Test Name</th>
								<th width="141" align="left">Training Name</th>
								<th width="171" align="left">Branch </th>
								<th width="98" align="left">Running</th>
								<th width="119" align="left" class="ac">Completed</th>
								<th width="199" align="left" class="ac">View</th>
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
								<td align="left"><span class="style2"><?php echo $rs->fields('Test_Id')?></span></td>
								<td align="left"><span class="style2"><?php echo $stmisc->getTestName($conn,$rs->fields('Test_Id')) ?></span></td>
								<td align="left"><span class="style2"><?php echo $stmisc->getTraining($conn1,$rs->fields('Training_Id')) ?></span></td>
								<td align="left"><span class="style2"><?php echo $stmisc->getBatch($conn1,$rs->fields('Batch_Id')) ?> [ <?php echo $rs->fields('No_Student')?> ]</span></td>
								<td align="left"><span class="style2"><font size="+3" color="#990000"><?php echo $stmisc->getR($conn,$rs->fields('Test_Id'),$rs->fields('Batch_Id')) ?></font></span></td>
								<td align="center"><font size="+3" color="#990000"><?php echo $stmisc->getF($conn,$rs->fields('Test_Id'),$rs->fields('Batch_Id')) ?></font></td>
								<td align="center"><a href="view_status.php?id=<?php echo $rs->fields('Test_Id')?>&bid=<?php echo $rs->fields('Batch_Id');?>" >View All Status</a> </td>
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