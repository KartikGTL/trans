<?php 
session_start();
if($_SESSION['username_stu']=="") {
header('location:http://www.psit.in');
}

require_once('conn.php');
$stmisc = new Misc();
   class Misc 
{
	
	function getAns($conn,$qid,$sid)
	{
    $sql="SELECT * FROM M_Answer WHERE Question_Id='".$qid."' and  Subject_Id='".$sid."' AND IsCorrect='1'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Answer_Id');
    return $no; 
    }
	function getTime($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Time');
    return $no; 
    }
	function getisStart($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('isStart');
    return $no; 
    }
	function getSubjectId($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Paper_Id');
    return $no; 
    }
	function getTestName($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('Test_Name');
    return $no; 
    }
	function getIsShow($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('isShow');
    return $no; 
    }
	function getNoQ($conn,$tid)
	{
    $sql="SELECT * FROM M_Test WHERE Test_Id='".$tid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('NoQ');
    return $no; 
    }
	function getMaxQ($conn,$sid)
	{
	$sql="SELECT MAX(Question_Id) as no FROM M_Question WHERE Subject_Id='".$sid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('no');
    return $no; 
    }
	function getMinQ($conn,$sid)
	{
	$sql="SELECT MIN(Question_Id) as no FROM M_Question WHERE Subject_Id='".$sid."'";
	$rs3 = $conn->execute($sql);
    $no=(string)$rs3->fields('no');
    return $no; 
    }
}
	

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$isStrat=$stmisc->getisStart($conn,$_GET['id']);
$str1 = "SELECT count(*) as no FROM M_Assign_Test_Student WHERE Student_Id='".$_SESSION['student_id']."' and Test_Id=".$_GET['id']."  " ;
$rs= $conn->execute($str1);
$str2 = "SELECT count(*) as no FROM M_TestByStudent WHERE Student_Id='".$_SESSION['student_id']."' and Test_Id=".$_GET['id']."  " ;
$rs2= $conn->execute($str2);
if($rs->fields('no')!=0 <br && $rs2->fields('no')!=1 &&$isStrat==1)
{
$str2 = "SELECT * FROM M_Assign_Test_Student WHERE Student_Id='".$_SESSION['student_id']."' and Test_Id=".$_GET['id']."  " ;
$rs2= $conn->execute($str2);
ini_set('date.timezone', 'Asia/Calcutta');
$date=date("F j, Y, g:i:s a");
echo $str3 = "insert into M_TestByStudent values ('".$_SESSION['student_id']."','".$_GET['id']."','$date','0','".$_SERVER['REMOTE_ADDR']."','0','0','0','0')" ;
$conn->execute($str3);
$_SESSION['isAllow']=(int)1;
$TnQ=$stmisc->getNoQ($conn,$rs2->fields('Test_id'));
$Student_Id=$_SESSION['student_id'];
$Test_Id=$rs2->fields('Test_id');
$isShow=$stmisc->getIsShow($conn,$rs2->fields('Test_id'));
$Test_Name=$stmisc->getTestName($conn,$rs2->fields('Test_id'));
$Subject_Id=$stmisc->getSubjectId($conn,$rs2->fields('Test_id'));
$time=$stmisc->getTime($conn,$rs2->fields('Test_id'));
}
else
{
header('location:home.php?msg=Access Denied for You !');
}


$QMAX=$stmisc->getMaxQ($conn,$Subject_Id);
$QMIN=$stmisc->getMinQ($conn,$Subject_Id);
$Qn='0';

$Q =  array(); 
$A =  array(); 
$CA =  array(); 
$TA =  array();
$A_BY_S =  array();
$arr= array(); 
for ($i = 0; $i < $TnQ ; $i++) {
 $CA[$i]='0'; 
  $TA[$i]='0'; 
  $A_BY_S[$i]='0'; 
  
}
$arr = UniqueRandomNumbersWithinRange($QMIN,$QMAX,$TnQ);
$_SESSION['CA']=$CA;  
$_SESSION['Q']=$arr;
$_SESSION['Qn']=$Qn;
$_SESSION['TnQ']=$TnQ; 
$_SESSION['TA']= $TA;
$_SESSION['A_BY_S']= $Q_BY_S;
$_SESSION['Student_Id']=$Student_Id;
$_SESSION['Subject_Id']=$Subject_Id;
$_SESSION['Test_Name']=$Test_Name;
$_SESSION['Test_Id']=(int)$Test_Id;
$_SESSION['isShow']=$isShow;
$_SESSION['time']=$time;
$_SESSION['Sys_Time']=(int)mktime(date(G),date(i),date(s),date(m),date(d),date(Y))-(int)$_GET['time']; 
for ($i = 0; $i<$TnQ ; $i++)
 {
 
 //echo $_SESSION['TA'][$i]; 

   //echo $_SESSION['Q'][$i];  
    // echo '<br>';
	
   $_SESSION['A'][$i]=$stmisc->getAns($conn,$_SESSION['Q'][$i],$Subject_Id);
  
}

header('location:test.php');


?>