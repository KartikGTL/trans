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
	
}
	
?>
<?php 
require_once('conn.php');
if($_SESSION['isAllow']==1)
{
header('location:test.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Exam</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<script>
function mktime() {
    // Get UNIX timestamp for a date  
    // 
    // version: 901.2514
    // discuss at: http://phpjs.org/functions/mktime
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: baris ozdil
    // +      input by: gabriel paderni 
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: FGFEmperor
    // +      input by: Yannoo
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: jakes
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Marc Palau
    // *     example 1: mktime(14, 10, 2, 2, 1, 2008);
    // *     returns 1: 1201871402
    // *     example 2: mktime(0, 0, 0, 0, 1, 2008);
    // *     returns 2: 1196463600
    // *     example 3: make = mktime();
    // *     example 3: td = new Date();
    // *     example 3: real = Math.floor(td.getTime()/1000);
    // *     example 3: diff = (real - make);
    // *     results 3: diff < 5
    // *     example 4: mktime(0, 0, 0, 13, 1, 1997)
    // *     returns 4: 883609200
    // *     example 5: mktime(0, 0, 0, 1, 1, 1998)
    // *     returns 5: 883609200
    // *     example 6: mktime(0, 0, 0, 1, 1, 98)
    // *     returns 6: 883609200
    
    var no, ma = 0, mb = 0, i = 0, d = new Date(), argv = arguments, argc = argv.length;

    if (argc > 0){
        d.setHours(0,0,0); d.setDate(1); d.setMonth(1); d.setYear(1972);
    }
 
    var dateManip = {
        0: function(tt){ return d.setHours(tt); },
        1: function(tt){ return d.setMinutes(tt); },
        2: function(tt){ var set = d.setSeconds(tt); mb = d.getDate() - 1; return set; },
        3: function(tt){ var set = d.setMonth(parseInt(tt)-1); ma = d.getFullYear() - 1972; return set; },
        4: function(tt){ return d.setDate(tt+mb); },
        5: function(tt){ return d.setYear(tt+ma); }
    };
    
    for( i = 0; i < argc; i++ ){
        no = parseInt(argv[i]*1);
        if (isNaN(no)) {
            return false;
        } else {
            // arg is number, let's manipulate date object
            if(!dateManip[i](no)){
                // failed
                return false;
            }
        }
    }

    return Math.floor(d.getTime()/1000);
}


function get() {

      document.getElementById('time').value= mktime();
	
}




</script>
	<script type="text/javascript">
function apply()
{
  document.frm.sub.disabled=true;
  if(document.frm.chk.checked==true)
  {
    document.frm.sub.disabled=false;
  }
  if(document.frm.chk.checked==false)
  {
 
    document.frm.sub.enabled=false;
  }
}
</script> 
	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
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
	
       
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left"> Important Instruction</h2>
					  <div class="right"></div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<div class="table">
						<center><table width="933" border="0" align="center">
  <tr>
    <td width="53" align="center"><img src="success.png" width="35" height="28" /></td>
    <td width="870" align="left"><font size="2" color="#000099" >The clock has been set at server and count down timer at the top right corner of the screen will display left out time to closure from where you can monitor time you have to complete the exam. 
</font></td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >Click one of the answer option buttons to select your answer. </font></td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >Click on <strong>RESET</strong> button to deselect a chosen answer. 
 </font></td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >Click on <strong>SAVE & NEXT</strong> to save the answer before moving to the next question. The next question will automatically be displayed. 
</font></td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >Make sure you click on <strong>SAVE & NEXT</strong> button everytime you want to save your answer. </font></td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >To go to a question, click on the question number on the top side of the screen. </font></td>
  </tr>
   <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >The color coded diagram on the right side of the screen shows the status of the questions :  </font></td>
  </tr>
  <tr>
    <td align="center"><div class="msg msg-error"><p><strong>1</strong></p></div></td>
    <td align="left"><font size="2" color="#000099" ><strong>Red</strong> - you have not answered question no <strong>1</strong>. </font></td>
  </tr>
   <tr>
    <td align="center"><div class="msg msg-ok"><p><strong>2</strong></p></div></td>
    <td align="left"><font size="2" color="#000099" ><strong>Green</strong> - you have answered question no <strong>2</strong>.</font> </td>
  </tr>
  <tr>
    <td align="center"><img src="success.png" width="35" height="28" /></td>
    <td align="left"><font size="2" color="#000099" >Do Not <strong>CLOSE WINDOW</strong> once the exam is started.This will <strong>LOCK</strong> your exam. You can connect with the exam invigilator to unlock and continue giving the exam. </font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><form id="frm" name="frm" method="get" action="startExam.php">
      <table width="431" border="0">
       
        <tr>
          <td width="42" align="right"><input name="chk" type="checkbox" class="style9" onClick="apply()">&nbsp;<input type="hidden" value="" name="time" id="time" /></td>
          <td width="379" align="left"><strong>I have read All Instruction carefully </strong></td>
        </tr>
		 <tr>
          <td align="right"><input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" /></td>
          <td align="left"> <input name="sub" type="submit" class="box-head" value="Start Now" disabled  onclick="get();"/></td>
        </tr>
      </table></form>
	  <br />
     
    </td>
  </tr>
</table></center>

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