<?php 
session_start();
if($_SESSION['username']=="") {
header('location:http://www.psit.in');
}
$myServer = "110.234.13.164";
$myUser = "sa";
$myPass = "Hcm786";
$myDB1 = "CollegeMaster12";
$conn1 = new COM ("ADODB.Connection");
$connStr1 = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB1; 
$conn1->open($connStr1);
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
	<style>
	.a{
	 font:Verdana;
	 font-size:15px;
	 color:#990000;
	 font-weight:bold;
	
	}
	</style>
	<script type="text/javascript">

		
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
function EW_selectKey(elem) {
	var f = elem.form;	
	if (!f.stid) return;
	if (f.stid[0]) {
		for (var i=0; i<f.stid.length; i++){
			f.stid[i].checked = elem.checked;
			

			
			
			}
		
	} else {
		f.stid.checked = elem.checked;	
		
	}
	ew_clickall(elem);
	
}



  </script>
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
			
			
		<br />
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
						<h2 class="left">Select  Test and Batch</h2>
					    <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
					  <div class="table">
					  <form name="form1" >
					    <table width="986" height="43" border="0">
                          <tr>
                            <td width="93"><strong>Test </strong></td>
                            <td width="196"><select name="test" class="field" id="test" >
                               
                                 <?php 
	$str = "SELECT Test_Name,Test_Id FROM M_Test order by Test_Id DESC";
 		$rs= $conn->execute($str);
		while (!$rs->EOF)  
		{if ($rs->fields('Test_Id') == $_GET['test'])
			{ ?>
				<option value="<?=$rs->fields('Test_Id')?>" selected     ><?=$rs->fields('Test_Name')?> </option>';
			<? }
			else
			{ ?>
		
                                <option value="<?php echo $rs->fields('Test_Id')?>" class="a"><?php echo $rs->fields('Test_Name')?></option>
                                <?php }
$rs->MoveNext();
}
?>
                              </select>
                            </td>
                            <td width="78"><strong>Training </strong></td>
                            <td width="217"><select name="training" class="field" id="training" onchange="window.document.form1.submit();">
                                <option value="0">-- SELECT BATCH --</option>
                                <?php 
	$str = "SELECT TraningName,Id FROM M_Traning ";
 		$rs= $conn1->execute($str);
		while (!$rs->EOF)  
		{if ($rs->fields('Id') == $_GET['training'])
			{ ?>
				<option value="<?=$rs->fields('Id')?>" selected     ><?=$rs->fields('TraningName')?> </option>';
			<? }
			else
			{ ?>
		
                                <option value="<?php echo $rs->fields('Id')?>" class="a"><?php echo $rs->fields('TraningName')?></option>
                                <?php }
$rs->MoveNext();
}
?>
                            </select></td>
							 <td width="117"><strong>Batch </strong></td>
                            <td width="259"><select name="batch" class="field" id="batch" onchange="window.document.form1.submit();">
                                <option value="0">-- SELECT BATCH --</option>
                                <?php 
	$str = "SELECT DISTINCT SectionName,SectionId FROM TrainingStudentMap where TId='".$_GET['training']."'ORDER BY SectionName ";
 		$rs= $conn1->execute($str);
		while (!$rs->EOF)  
		{
		if ($rs->fields('SectionId') == $_GET['batch'])
			{ ?>
				<option value="<?=$rs->fields('SectionId')?>" selected     > <?=$rs->fields('SectionName')?></option>';
			<? }
			else
			{ ?>
		
                                <option value="<?php echo $rs->fields('SectionId')?>" class="a"><?php echo $rs->fields('SectionName')?></option>
                                <?php }
$rs->MoveNext();
}
?>
                            </select></td>
                          </tr>
                        </table></form>
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
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Assign Test to Batch</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<div class="table"><form action="insert_assignment.php" method="POST">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="122">S. No. </th>
								<th width="182">Student Id</th>
								<th width="195">Batch Name </th>
								<th width="271">Student Name </th>
								<th width="216" class="ac"> <input type="checkbox" name="chkAll" id="chkAll"  onclick="EW_selectKey(this);" /></th>
							</tr>
							<?  
							$test=$_GET['test'];
							$batch=$_GET['batch'];
							$training=$_GET['training'];
 $s="SELECT * FROM  TrainingStudentMap WHERE (SectionId='".$batch."')  and TId='".$training."' ORDER BY Name";
$rs5 = $conn1->execute($s);
		$ww=1;
	
		  while (!$rs5->EOF)  
          {
		     
			 $UniversityRollNo =$rs5->fields('UniversityRollNo');
			  $Name =$rs5->fields('Name');
			  $StudentId =$rs5->fields('StudentId');
			  $SectionName =$rs5->fields('SectionName');

 $bgcol = ($ww%2==0?"#DFFFFF":""); 

?>

							
							<tr bgcolor="<?php echo $bgcol; ?>">
								<td align="left"><?php echo $ww;?></td>
								<td align="left"><?php echo $StudentId;?></td>
								<td align="left"><?php echo  $SectionName;?></td>
								<td align="left"><input type="hidden" name="name[]"  value="<?php echo $Name; ?>" /><?php echo $Name;?></td>
							  <td align="center"><input type="checkbox" name="stid[]" id="stid" value="<?php echo $StudentId; ?>" onclick="countCheckboxes()" /></td>
							</tr>
							
							<?php
			$ww++;
			 $rs5->MoveNext();
			
		   }
	  
	?>
						</table><input type="hidden" name="test_id" value="<?=$test?>" />
				               <input type="hidden" name="batch_id" value="<?=$batch?>" />
				                 <input type="hidden" name="training_id" value="<?=$training?>" /><br />
						<center><input type="submit" class="button" value="SUBMIT"  />
						</center>
						</form></div>
						
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