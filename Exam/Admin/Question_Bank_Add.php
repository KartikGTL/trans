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
   
	<script>
function validateForm()
{
var b= document.getElementById("answer1").value;
var c= document.getElementById("answer2").value;
var d= document.getElementById("answer3").value;
var e= document.getElementById("answer4").value;


if(b=="" || b==null)

{
document.getElementById("err").innerHTML = "OPTION 1 CAN NOT BE BLANK.. !!";
return (false);
}

else
if(c=="" || c==null)

{
document.getElementById("err").innerHTML = "OPTION 2 CAN NOT BE BLANK.. !!";
return (false);
}

else
if(d=="" || d==null)

{
document.getElementById("err").innerHTML = "OPTION 3 CAN NOT BE BLANK.. !!";
return (false);
}

else
if(e=="" || e==null)

{
document.getElementById("err").innerHTML = "OPTION 4 CAN NOT BE BLANK.. !!";
return (false);
}
var radios = document["form1"].elements["IsCorrect"];
 for (var i=0; i <radios.length; i++) {
  if (radios[i].checked) {
   var j=1;
 
  }
 }
if(j!=1)
{
document.getElementById("err").innerHTML = "select any choice.. !!";
return (false);
}
}
</script>
 <style type="text/css">
<!--
.style1 {
	color: #990000;
	font-weight: bold;
}
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
			    <li><a href="Question_Bank.php" class="active"><span>Question Bank</span></a></li>
			    <li><a href="Create_Test.php"><span>Create Test</span></a></li>
			    <li><a href="All_Test.php"><span>All Test</span></a></li>
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
		<div class="small-nav"><font size="+2"><?php echo $_GET['name'];?></font></div>
		<!-- End Small Nav -->
		
		<!-- Message OK --><!-- End Message OK -->		
		
		<!-- Message Error -->
		<!-- End Message Error -->
        <br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<!-- End Box -->
                <!-- Box -->
<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Add New Question</h2>
					</div>
					<!-- End Box Head -->
					
					<form name="form1" action="add_question.php" method="post" onsubmit="return validateForm(); ">
						<input type="hidden" name="subject_id" value="<?php echo $_GET['id']?>"  />
						<!-- Form -->
						<div class="form">
						  <p>
									<span class="req">max 100 symbols</span>
									<label>Question  <span>(Required Field)</span></label>
										<textarea class="ckeditor" cols="80" id="question" name="question" rows="10" >   </textarea>
						  </p>	
							<center><table width="308" border="1" align="center" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="154" align="center"><span class="style1">Option's</span></td>
    <td width="144" align="center"><span class="style1">Correct Answer </span></td>
  </tr>
  <tr>
    <td><input name="answer1" type="text" size="25" maxlength="50" id="answer1" /></td>
    <td align="center"><input name="IsCorrect" type="radio" value="answer1" id="IsCorrect" /></td>
  </tr>
  <tr>
    <td><input name="answer2" type="text" size="25" maxlength="50" id="answer2" /></td>
    <td align="center"><input name="IsCorrect" type="radio" value="answer2" id="IsCorrect"/></td>
  </tr>
  <tr>
    <td><input name="answer3" type="text" size="25" maxlength="50" id="answer3" /></td>
    <td align="center"><input name="IsCorrect" type="radio" value="answer3" id="IsCorrect"/></td>
  </tr>
  <tr>
    <td><input name="answer4" type="text" size="25" maxlength="50" id="answer4" /></td>
    <td align="center"><input name="IsCorrect" type="radio" value="answer4" id="IsCorrect"/></td>
  </tr>
</table>
							</center>

					  </div>
						<!-- End Form -->
						
						<!-- Form Buttons -->
						<div class="buttons">
						<center>  <input type="submit" class="button" value="submit" /></center>
					  </div>
					  <center><font color="#FF0000"><div id="err"></div></font></center>
						<!-- End Form Buttons -->
					</form>
			  </div>
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