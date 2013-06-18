<?php
session_start();
echo $Qn=$_GET['question_id'];
$S_Id=$_SESSION['Subject_Id'];
$Qn=$Qn-1;
?>
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
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
			url: "filterdetails.php?answer_id="+rad_val+"&question_id="+<?php echo $Qn;?>,
			success : function (data) {
			$("#searchresult").html(data);
				}
			});
	
});	
	
  };
 
        </script>
		
		<script type="text/javascript">
  function dateChanged_pre() {
   
		$.ajax({
			type: "GET", 
			url: "filterdetails_pre.php?question_id="+<?php echo $Qn;?>,
			success : function (data) {
			$("#searchresult").html(data);
				}
			});
		$("#searchImage").ajaxStop(function(){
	  $(this).hide();
});	
	
  };
 
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

			$str='<table width="991" border="0">
  <tr>
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
</table>';
			
		
		
	
      $str.= ' <br />';
	
 $str.='<div id="main">';
			 $str.='<div class="cl">&nbsp;</div>';
			
			
			 $str.='<div id="content">';
				
				
				 $str.='<div class="box">';
					
					 $str.='<div class="box-head">';
						$str.='<h2 class="left">Question No.';
						echo $str;
						 ?>
						 
						<?php echo $Qn+1;
						 ?>
						 <?php
						 
					   $str='</h2><div class="right"></div>';
					 $str.='</div>';
					

					 $str.='<div class="table">';
					
 $str.='<table width="983" height="267" border="0" align="center">';
 
  $str.= '<tr>';
     $str.='<td height="203" colspan="2">'.$stmisc->getQues($conn,$_SESSION['Q'][$Qn],$S_Id).'<br/><br/>';
	 echo $str;
	 ?>
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
		
		
	 <?php
	 
	 
      $str='</td></tr>';
    $str.='<tr>';
      $str.='<td width="463" align="left">';
	  echo $str;
	  if($Qn-1!=-1){
	  ?>
	  
	  <input name="Submit2" type="submit" class="box-head" value="PREVIOS" onclick="dateChanged_pre();" />
	  <?php
	  }
	  $str='</td>';
      $str.='<td width="510" align="right">';
	  echo $str;
	  if($Qn+1!=$_SESSION['TnQ']){
	  ?>
	  <input name="Submit" type="submit" class="box-head" value="NEXT &amp; SAVE"  onclick="dateChanged();"/>
	 <?php 
	 }else{
	 
	 ?>
	  <input name="Submit" type="submit" class="box-head" value="FINISH"  />
	 
	 
	<?php }
	  $str='</td>';
	  
    $str.='</tr>';
  $str.='</table>';
  
   $str.= '</span>
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
</div>';
  
echo $str;
?>
