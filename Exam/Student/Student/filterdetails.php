<?php
session_start();
if($_SESSION['username_stu']=="" || $_SESSION['isAllow']==0) {
header('location:http://www.psit.in');
}
$Qn=$_GET['question_id'];
$S_Id=$_SESSION['Subject_Id'];
$Action=$_GET['action'];
?>
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
<script type="text/javascript">
 
  $(document).ready(function(){
 
   $("#reset").click(function () {
 
	$('input:radio[name=answer]').attr('checked',false);
 
    });
 
  });
</script>
<script LANGUAGE="JavaScript">
<!--
function confirmPost()
{
var agree=confirm("Are you sure you want to Submit  ?");
if (agree)
window.open("result.php","_parent");
else
return false ;
}
// -->
</script>
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
  function finish() {
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
			url: "finish.php?answer_id="+rad_val+"&action=N&question_id="+<?php echo $Qn+1;?>,
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
  function dateChanged_pre() {
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
		    url: "filterdetails.php?answer_id="+rad_val+"&action=P&question_id="+<?php echo $Qn-1;?>,
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
<?php 
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



?>
<?php

if($Action=='N')
{
$ans_in_db=(int)$_SESSION['A'][$Qn-1];
$ans_by_stu=(int)$_GET['answer_id'];
$ques_by_stu=$Qn;
$ans_in_db=$_SESSION['A'][$ques_by_stu];
if($ans_by_stu!=0)
{
$_SESSION['TA'][$Qn-1]='1';

     if((int)$_SESSION['A'][$Qn-1]==(int)$_GET['answer_id'])
       {
        $_SESSION['A_BY_S'][$Qn-1]=(int)$_GET['answer_id'];
         $str3 = "Delete FROM M_AnswerByStudent WHERE Student_Id='".$_SESSION['student_id']."' AND Qustion_Id='".$_SESSION['Q'][$Qn-1]."'" ;
          $conn->execute($str3);
         $str3 = "insert into M_AnswerByStudent values ('".$_SESSION['student_id']."','".$_SESSION['Q'][$Qn-1]."','".$_GET['answer_id']."','".$_SESSION['Test_Id'].   "','1')" ;
$conn->execute($str3);
$_SESSION['CA'][$Qn-1]='1';
}
else
{
$_SESSION['A_BY_S'][$Qn-1]=(int)$_GET['answer_id'];

 $str3 = "Delete FROM M_AnswerByStudent WHERE Student_Id='".$_SESSION['student_id']."' AND Qustion_Id='".$_SESSION['Q'][$Qn-1]."'" ;
$conn->execute($str3);
$str3 = "insert into M_AnswerByStudent values ('".$_SESSION['student_id']."','".$_SESSION['Q'][$Qn-1]."','".$_GET['answer_id']."','".$_SESSION['Test_Id']."','0')" ;
$conn->execute($str3);
$_SESSION['CA'][$Qn-1]='-1';

   }


}
else {
 $str3 = "Delete FROM M_AnswerByStudent WHERE Student_Id='".$_SESSION['student_id']."' AND Qustion_Id='".$_SESSION['Q'][$Qn-1]."'" ;
$conn->execute($str3);
$_SESSION['TA'][$Qn-1]='0';
$_SESSION['CA'][$Qn-1]='0';
$_SESSION['A_BY_S'][$Qn-1]='0';
}
 //print_r ($_SESSION['CA']);
//echo $_SESSION['CA']['0'];

//echo $_SESSION['CA']['1']; 
 
//echo $_SESSION['CA']['2'];
 
//echo $_SESSION['CA']['3'];
}		
		 echo  '<table width="991" border="0">';
  echo '<tr>';

  
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
  
  
 
 echo '</tr>';
echo '</table>';

$str.= '<br />';
$str.='<div id="main">';
$str.='<div id="content">';
$str.='<div class="box">';
$str.='<div class="box-head">';
$str.='<h2 class="left">Question No.'.(int)($Qn+1).' of '.$_SESSION['TnQ'];
$str.='</h2>';
$str.='</div>';

$str.='<div class="table">';
$str.='<table width="983" height="267" border="0" align="center">';
$str.= '<tr>';
$str.='<td height="203" colspan="2">'.$stmisc->getQues($conn,$_SESSION['Q'][$Qn],$S_Id).'<br/><br/>';
$str.='<center><form name="orderform" method="get"><table width="205" border="0" align="center">';
$str.='<tr>';
$str.='<td width="38" align="center"></td>';
$str.='<td width="157" align="left"></td>';
$str.='</tr>';

$strOP = "SELECT * FROM M_Answer WHERE Question_Id='".$_SESSION['Q'][$Qn]."'  AND Subject_Id='$S_Id' ";
 		$rs1 = $conn->execute($strOP);
		while (!$rs1->EOF)  
		{
	 $ans_id=$rs1->fields('Answer_Id');
		 $ans_text=$rs1->fields('Answer_Text');
$str.='<tr>';
$str.='<td width="38" align="center"><input name="answer" type="radio" value="'.$ans_id.'"';
 if($_SESSION['A_BY_S'][$Qn]==$ans_id){ $str.='checked'; }
$str.='/></td>';
$str.='<td width="157" align="left"><font face="Verdana" size="+1" color="#000000">'.$ans_text.'</font></td>';
$str.='</tr>';

		$rs1->MoveNext();
		 }
		
$str.='</table>';
$str.='</form>';
$str.='</center>';

$str.='</td></tr>';
$str.='<tr>';
$str.='<td width="463" align="left">';
if($Qn-1!=-1){
$str.='<input name="Submit2" type="submit" class="box-head" value="PREVIOUS" onclick="dateChanged_pre();" />';
}
$str.='</td>';

$str.='<td width="510" align="right">';
 if($Qn+1!=$_SESSION['TnQ']){

$str.='<input type="button" value="RESET" id="reset" class="box-head">&nbsp;&nbsp;<input name="Submit" type="submit" class="box-head" value="SAVE & NEXT"  onclick="dateChanged();"/>';
 }else{
$str.='<input type="button" value="RESET" id="reset" class="box-head">&nbsp;&nbsp;<input name="Submit" type="submit" class="box-head" value="SAVE & NEXT"  onclick="finish();"/>';
}
$str.='</td>';
$str.='</tr>';
$str.='</table>';

$str.='<table width="902" border="0">';
$str.=' <tr>';
$str.='<td width="930"><center><input type="button" value="SUBMIT" class="box-head" onClick="return confirmPost()"></center></td>';
$str.=' </tr>';
$str.='</table>';









$str.= '</span><span id="searchImage" style="display:none" >';
$str.= '<table width="100%">';
$str.= '<tr>';
$str.= '<td align="left" valign="bottom"><img src="pleasewait_gif_ani.gif" width="100" height="100" /></td>';
$str.= '</tr>';
$str.= '</table></span>';
$str.= '</div>';
$str.= '</div>';
$str.= '</div>';
$str.= '<div class="cl">&nbsp;</div>';			
$str.= '</div>';

echo $str;
?>
