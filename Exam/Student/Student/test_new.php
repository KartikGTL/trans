<?php 
session_start();
require_once('conn.php');
$stmisc = new Misc();
   class Misc 
{
	
	function getQues($conn,$qid,$sid)
	{
   $sql="SELECT * FROM M_Question WHERE Question_Id='".$qid."' AND Subject_Id='".$sid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Question');
    return $no; 
    }
	
}
$Qn=$_SESSION['Qn'];
$S_Id=$_SESSION['Subject_Id'];


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
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">PSIT Online Test</a></h1>
			<div id="top-navigation">
			  <table width="316" height="72" border="0">
                <tr>
                  <td width="111">Student Name</td>
                  <td width="133">Prateek jaiswal </td>
                </tr>
                <tr>
                  <td>Test Name</td>
                  <td>Aptitude</td>
                </tr>
                <tr>
                  <td>Remaining Time </td>
                  <td>34:12</td>
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
		  
		  
		  
			<table width="991" border="0">
<tr>
  <?php if($_SESSION['TnQ']<=20) 
  {$TnQ_Temp=$_SESSION['TnQ'];
  }
  
  ?>
    <td width="39"><div class="msg msg-ok"><p><strong><a href="#">1</a></strong></p></div></td>
    <td width="39"><div class="msg msg-ok"><p><strong><a href="#">2</a></strong></p></div></td>
	<td width="39"><div class="msg msg-error"><p><strong><a href="#">3</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">4</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">5</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">6</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">7</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">8</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">9</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">10</a></strong></p></div></td>
	 <td width="39"><div class="msg msg-ok"><p><strong><a href="#">11</a></strong></p></div></td>
    <td width="39"><div class="msg msg-ok"><p><strong><a href="#">12</a></strong></p></div></td>
	<td width="39"><div class="msg msg-error"><p><strong><a href="#">13</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">14</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">15</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">16</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">17</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">18</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">19</a></strong></p></div></td>
    <td width="39"><div class="msg msg-error"><p><strong><a href="#">20</a></strong></p></div></td>
  </tr>
</table>

			
		
		
	
        <br />
	
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			
			<div id="content">
				
				
				<div class="box">
					
					<div class="box-head">
						<h2 class="left">Question No.<?php echo '1'?></h2>
					  <div class="right"></div>
					</div>
					

					<div class="table">
					
					  
					
					  <table width="983" height="244" border="0" align="center">
    <tr>
      <td height="189" colspan="2" align="left" valign="top"><?php echo $stmisc->getQues($conn,$_SESSION['Q'][$Qn],$S_Id);?> <br /><br />
      <center>  <form name="orderform" method="post"><table width="205" border="0" align="center">
	   <tr>
            <td width="38" align="center"></td>
            <td width="157" align="left"></td>
          </tr>
		 
		 <?php 
		  $strOP = "SELECT * FROM M_Answer WHERE Question_Id='".$_SESSION['Q'][$Qn]."'  AND Subject_Id='$S_Id' ";
 		$rs1 = $conn->execute($strOP);
		while (!$rs1->EOF)  
		{
		  ?>
          <tr>
            <td width="38" align="center"><input name="answer" type="radio" value="<?=$rs1->fields('Answer_Id');?>" /></td>
            <td width="157" align="left"><font face="Verdana" size="+1" color="#000000" ><?=$rs1->fields('Answer_Text');?></font></td>
          </tr>
         <?php 
		 $rs1->MoveNext();
		 }
		 ?>
        </table>
		</form>
		</center>
		</td>
    </tr>
   
    <tr>
      <td width="463" height="49" align="left"><?php if($Qn-1!=-1){?><input name="Submit2" type="submit" class="box-head" value="PREVIOS" onClick="dateChanged_pre();" /><?php }?></td>
      <td width="510" align="right"><input name="Submit" type="submit" class="box-head" value="NEXT &amp; SAVE"  onclick="dateChanged();"/></td>
    </tr>
	
  </table>
					  </span>
  <span id="searchImage" style="display:none" >
		<table width="100%">

		  <tr>
			<td align="left" valign="bottom"><img src="pleasewait_gif_ani.gif" width="100" height="100" /></td>
		  </tr>
		</table>
	
</span>

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
<script type="text/javascript">
  function dateChanged() {
   var rad_val ='';
	for (var i=0; i < document.orderform.answer.length; i++)
   {
   if (document.orderform.answer[i].checked)
      {
       rad_val = document.orderform.answer[i].value;
	  
      }
   }
   
		$.ajax({
			type: "GET", 
			url: "filterdetails_new.php?answer_id="+rad_val+"&action=N&question_id="+<?php echo $Qn+1;?>,
			success : function (data) {
			$("#searchresult").html(data);
				}
			});
		$("#searchImage").ajaxStop(function(){
	  $(this).hide();
});	
	
  };
 
        </script>
		
		