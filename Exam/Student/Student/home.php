<?php 
session_start();
if($_SESSION['username_stu']=="") {
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
	function getisStart($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
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
	function getTime($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Time');
    return $no; 
    }
	function getC($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('M_C');
    return $no; 
    }
	function getIC($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('M_IC');
    return $no; 
    }
	function getNQ($conn,$tid)
	{
  $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('NoQ');
    return $no; 
    }
	function isComp($conn,$tid,$sid)
	{
  $sql="SELECT count(*) as no FROM M_TestByStudent WHERE Student_Id='".$sid."' AND Test_Id='".$tid."' and isCompleted='1'";
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
	<link rel="stylesheet" href="css/style_new.css" type="text/css" media="all" />
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
<script>
 function openerNew(id)
        {
            var params =  'top=0, left=0';
          
            params += ', width='+screen.width+', height='+screen.height+',statusbar=no,toolbar=no,location=no,directories=no,menubar=no,resizable=no';
            params += ', scrollbars=yes, status=no, fullscreen=yes';
           // createDefaultSubject();
            newwin=window.open("start.php?id="+id,"_parent", params);

            if (window.focus) {newwin.focus()}

            return false;
        }
		</script>
    <style type="text/css">
<!--
.style2 {font-size: 16px}
-->
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
				Welcome <strong><?php echo $_SESSION['name']?></strong>
				<span>|</span>
				<a href="logout.php">Log out</a>
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
		<div class="small-nav"></div>
	<?php if($_GET['msg']!=''){?>
		
		<div class="msg msg-error">
			<p><strong><?php echo $_GET['msg']?></strong></p>
			<a href="#" class="close">close</a>
	  </div>
		
		<?php }?>
       
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">All Assigned Exam</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="85" align="left">Test Id</th>
								<th width="106" align="left">Test Name</th>
								<th width="127" align="left">No. of Question </th>
								<th width="166" align="left">For Correct </th>
								<th width="157" align="left">For InCorrect </th>
								<th width="104" align="left">Time</th>
								<th width="138" align="left">Assigned Date</th>
								<th width="103" align="left" class="ac">Action</th>
							</tr>
							<?php 
	  $str = "SELECT * FROM M_Assign_Test_Student WHERE Student_Id='".$_SESSION['student_id']."' " ;
 		$rs= $conn->execute($str);
$i=0;
		while (!$rs->EOF)  
		{
	 $bgcol = ($i%2==0?"#DFFFFF":""); 


?>
							<tr bgcolor="<?php echo $bgcol; ?>">
								<td bgcolor="#666666"><span class="style2"><?php echo $rs->fields('Test_Id')?></span></td>
								<td bgcolor="#666666"><span class="style2"><?php echo $stmisc->getTestName($conn,$rs->fields('Test_Id')) ?></span></td>
                                 <td bgcolor="#666666"><span class="style2"><?php echo $stmisc->getNQ($conn,$rs->fields('Test_Id')) ?></span></td>
								<td bgcolor="#666666"><span class="style2"><font face="Verdana" color="#009900" >+ <?php echo $stmisc->getC($conn,$rs->fields('Test_Id')) ?></font></span></td>
								<td bgcolor="#666666"><span class="style2"><font face="Verdana" color="#CC0000">- <?php echo $stmisc->getIC($conn,$rs->fields('Test_Id')) ?></font></span></td>
								<td bgcolor="#666666"><span class="style2"><font face="Verdana" color="#000099"><?php echo $stmisc->getTime($conn,$rs->fields('Test_Id')) ?> MIN</font></span></td>
								<td bgcolor="#666666"><span class="style2"><?php echo $rs->fields('Date')?></span></td>
								
								<td align="center" bgcolor="#666666">
								  <span class="style2">
								  
								  <?php if($stmisc->isComp($conn,$rs->fields('Test_Id'),$_SESSION['student_id'])==1){?>
								 <a href="view_result.php?id=<?php echo $rs->fields('Test_Id')?>" rel="facebox"><img src="result.png" /></a>
								  <?php }else {?>
							
								<?php if($stmisc->getisStart($conn,$rs->fields('Test_Id'))==0){?>
								<img src="start1 copy.png" />
								<?php }else{ ?>
								<a href="#" onClick="openerNew(<?php echo $rs->fields('Test_Id')?>);"><img src="start.png" /></a>
								
								<?php }}?>	
															
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
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<!-- Footer -->
  <?php include("footer.php"); ?>
<!-- End Footer -->
	
</body>
</html>