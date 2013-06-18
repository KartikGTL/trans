<?php 
session_start();
if($_SESSION['username_stu']=="" || $_SESSION['isAllow']==0) {
header('location:http://www.psit.in');
}
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
<?php
$test_id="'".$_SESSION['time']."'";
//$_SESSION[$test_id]='9';

$minutes = $_SESSION['time']; // Enter minutes
$seconds = 0; // Enter seconds
$time_limit = ($minutes * 60) + $seconds + 1; // Convert total time into seconds
if(!isset($_SESSION[$test_id])){$_SESSION[$test_id] = mktime(date(G),date(i),date(s),date(m),date(d),date(Y))-$_SESSION['Sys_Time'] + $time_limit;} // Add $time_limit (total time) to start time. And store into session variable.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Exam</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	
	
	<script type="text/javascript">
	function killCopy(e){

return false

}

function reEnable(){

return true

}

document.onselectstart=new Function ("return false")

if (window.sidebar){

document.onmousedown=killCopy

document.onclick=reEnable

}
</script>

	
	<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
	<link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
	<script type="text/javascript">
 
  $(document).ready(function(){
 
   $("#reset").click(function () {
 
	$('input:radio[name=answer]').attr('checked',false);
 
    });
 
  });
</script>
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
	<script>
	
var ct = setInterval("calculate_time()",100); // Start clock.
function calculate_time()


{
 var end_time = "<?php echo $_SESSION[$test_id]; ?>"; // Get end time from session variable (total time in seconds).


 var dt = new Date(); // Create date object.
 var time_stamp = dt.getTime()/1000; // Get current minutes (converted to seconds).
 var total_time = end_time - Math.round(time_stamp); // Subtract current seconds from total seconds to get seconds remaining.


 var mins = Math.floor(total_time / 60); // Extract minutes from seconds remaining.
 var secs = total_time - (mins * 60); // Extract remainder seconds if any.
 if(secs < 10){secs = "0" + secs;} // Check if seconds are less than 10 and add a 0 in front.


 document.getElementById("txt").value = mins + ":" + secs; // Display remaining minutes and seconds.
 // Check for end of time, stop clock and display message.
 if(mins <= 0)
 {
  if(secs <= 0 || mins < 0)


  {
   clearInterval(ct);
   document.getElementById("txt").value = "0:00";
	window.alert("Time is up. Press OK to continue."); // change timeout message as required
document.forms[0].method="POST"
document.forms[0].action="result.php"
document.forms[0].submit()
   }
  }
 }
</script>
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
                  <td align="left" ><font face="Verdana" size="2"><?php echo $_SESSION['Test_Name'];?> [ <?php echo $_SESSION['Test_Id'];?> ] </font></td>
                </tr>
                <tr>
                  <td align="left"><font face="Verdana" size="2">Remaining Time : </font></td>
                  <td align="left"><input id="txt" readonly name="time" ></td>
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
  
 <?php 
  if(sizeof($_SESSION['CA'])>=1)
  {
  if($_SESSION['TA'][0]=='1') 
  {

   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'0'.');">1</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'0'.');">1</a></strong></p></div></td>';
	
	 }
  }
  ?>
   
    <?php 
  if(sizeof($_SESSION['CA'])>=2)
  {
  if($_SESSION['TA'][1]=='1' ) 
  {
 

   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'1'.');">2</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'1'.');">2</a></strong></p></div></td>';
	
	 }
  }
  ?>
	  <?php 
  if(sizeof($_SESSION['CA'])>=3)
  {
  if($_SESSION['TA'][2]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'2'.');">3</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'2'.');">3</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=4)
  {
  if($_SESSION['TA'][3]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'3'.');">4</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'3'.');">4</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=5)
  {
  if($_SESSION['TA'][4]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'4'.');">5</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'4'.');">5</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=6)
  {
  if($_SESSION['TA'][5]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'5'.');">6</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'5'.');">6</a></strong></p></div></td>';
	
	 }
  }
  ?>
   <?php 
  if(sizeof($_SESSION['CA'])>=7)
  {
  if($_SESSION['TA'][6]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'6'.');">7</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'6'.');">7</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=8)
  {
  if($_SESSION['TA'][7]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'7'.');">8</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'7'.');">8</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=9)
  {
  if($_SESSION['TA'][8]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'8'.');">9</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'8'.');">9</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=10)
  {
  if($_SESSION['TA'][9]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'9'.');">10</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'9'.');">10</a></strong></p></div></td>';
	
	 }
  }
  ?>
   <?php 
  if(sizeof($_SESSION['CA'])>=11)
  {
  if($_SESSION['TA'][10]=='1') 
  {

   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'10'.');">11</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'10'.');">11</a></strong></p></div></td>';
	
	 }
  }
  ?>
   
    <?php 
  if(sizeof($_SESSION['CA'])>=12)
  {
  if($_SESSION['TA'][11]=='1' ) 
  {
 

   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'11'.');">12</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'11'.');">12</a></strong></p></div></td>';
	
	 }
  }
  ?>
	  <?php 
  if(sizeof($_SESSION['CA'])>=13)
  {
  if($_SESSION['TA'][12]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'12'.');">13</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'12'.');">13</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=14)
  {
  if($_SESSION['TA'][13]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'13'.');">14</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'13'.');">14</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=15)
  {
  if($_SESSION['TA'][14]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'14'.');">15</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'14'.');">15</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=16)
  {
  if($_SESSION['TA'][15]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'15'.');">16</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'15'.');">16</a></strong></p></div></td>';
	
	 }
  }
  ?>
   <?php 
  if(sizeof($_SESSION['CA'])>=17)
  {
  if($_SESSION['TA'][16]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'16'.');">17</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'16'.');">17</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=18)
  {
  if($_SESSION['TA'][17]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'17'.');">18</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'17'.');">18</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=19)
  {
  if($_SESSION['TA'][18]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'18'.');">19</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'18'.');">19</a></strong></p></div></td>';
	
	 }
  }
  ?>
    <?php 
  if(sizeof($_SESSION['CA'])>=20)
  {
  if($_SESSION['TA'][19]=='1') 
  {
 
   echo '<td width="39"><div class="msg msg-ok"><p><strong><a href="#" onClick="dateChanged_direct('.'19'.');">20</a></strong></p></div></td>';

  }
  else
  {
    echo '<td width="39"><div class="msg msg-error"><p><strong><a href="#" onClick="dateChanged_direct('.'19'.');">20</a></strong></p></div></td>';
	
	 }
  }
  ?>
  </tr>
</table>

			
		
		
	
        <br />
	
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			
			<div id="content">
				
				
				<div class="box">
					
					<div class="box-head">
						<h2 class="left">Question No.<?php echo '1'?> of <?php echo $_SESSION['TnQ'];?></h2>
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
            <td width="38" align="center"><input name="answer" type="radio" value="<?=$rs1->fields('Answer_Id');?>" <?php if($_SESSION['A_BY_S'][$Qn]==$rs1->fields('Answer_Id')){?>checked<?php }?> /></td>
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
      <td width="463" height="49" align="left"><?php if($Qn-1!=-1){?><input name="Submit2" type="submit" class="box-head" value="PREVIOUS" onClick="dateChanged_pre();" /><?php }?></td>
      <td width="510" align="right"><input type='button' value='RESET' id='reset' class="box-head">&nbsp;&nbsp;<input name="Submit" type="submit" class="box-head" value="SAVE & NEXT"  onclick="dateChanged();"/></td>
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
			url: "filterdetails.php?answer_id="+rad_val+"&action=N&question_id="+<?php echo $Qn+1;?>,
			success : function (data) {
			$("#searchresult").html(data);
				}
			});
		$("#searchImage").ajaxStop(function(){
	  $(this).hide();
});	
	
  };
 
        </script>
		
		<script type="text/javascript">
  function dateChanged_direct(qn) {
 	$.ajax({
			type: "GET", 
		    url: "filterdetails.php?action=D&question_id="+qn,
			success : function (data) {
			$("#searchresult").html(data);
				}
			});
		$("#searchImage").ajaxStop(function(){
	  $(this).hide();
});	
	
  }
 
        </script>