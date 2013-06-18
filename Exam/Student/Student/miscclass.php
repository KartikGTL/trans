<?php 
session_start();
if($_SESSION['username']=="") {
header('location:http://www.psit.in');
}

?>
<?php

class Misc 
{
	
	
	function GetData($conn,$sid,$day,$p)
	{
	$sql="SELECT count(*) as no FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
	$no=(string)$rs3->fields('no');
	if($no!=0){
		 $sql="SELECT CSF_Id FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
		
		     $csf_id=(string)$rs3->fields('CSF_Id');
		}
		else
		{
		$csf_id=0;
		}
		return $csf_id; 
		   
	}
	function GetDataName($conn,$sid,$day,$p)
	{
	$sql="SELECT count(*) as no FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
	$no=(string)$rs3->fields('no');
	if($no!=0){
		 $sql="SELECT Name,Subject_code,subject FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
		
		     $name=(string)$rs3->fields('Name');
			 $subject_code=(string)$rs3->fields('Subject_code');
		}
		else
		{
		$name='NOF';
		$subject_code='NOS';
		}
		$value=$name;
		return $value; 
		   
	}
	function GetDataNameSubject($conn,$sid,$day,$p)
	{
	$sql="SELECT count(*) as no FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
	$no=(string)$rs3->fields('no');
	if($no!=0){
		 $sql="SELECT subject FROM V_TimeTable_New WHERE Section_Id='".$sid."' AND  TimeTableId='12' AND TT_Day='".$day."' AND TT_Period='".$p."'";
	    $rs3 = $conn->execute($sql);
		
		    
			 $subject=(string)$rs3->fields('subject');
		}
		else
		{
	
		$subject='NOS';
		}
		
		return $subject; 
		   
	}
	function GetDataPeriod($conn,$csf,$day)
	{
		 $sql="SELECT count(*)  as no FROM V_2012_All_Topic WHERE CSF_Id='".$csf."' AND [Date]='".$day."' ";
	    $rs3 = $conn->execute($sql);
		
		     $no=(string)$rs3->fields('no');
		  if($no!=0)
		  {
		  $no=1;
		  }
		
		return $no; 
		   
	}
	function GetTopic($conn,$csf,$day,$date,$p)
	{
		 $sql="SELECT count(*)  as no FROM V_2012_All_Topic WHERE CSF_Id='".$csf."' AND [Date]='".$date."' and Period='".$p."'";
	    $rs3 = $conn->execute($sql);
		
		    $no1=(int)$rs3->fields('no');
			
		  if($no1!=0)
		  {
		$sql="SELECT  TopicName FROM V_2012_All_Topic WHERE CSF_Id='".$csf."' AND [Date]='".$date."' and Period='".$p."'";
	    $rs3 = $conn->execute($sql);
		
		    $no=(string)$rs3->fields('TopicName');
		 
		  }
	    else
	
	     {
	    $no='NOT';
	      }
	
		
		return $no; 
		   
	}
	function GetNoOfStu($conn,$csf,$day)
	{
		 $sql="SELECT count(*) as no FROM M_2009_Attendance_Absent WHERE CSF_Id='".$csf."' AND [Date]='".$day."' and session_id='12'";
	    $rs3 = $conn->execute($sql);
		
		     $no1=(string)$rs3->fields('no');
			  $sql="SELECT count(*) as no FROM M_Attendance_Lab WHERE CSF_Id='".$csf."' AND [Date]='".$day."' and session_id='12'";
	         $rs3 = $conn->execute($sql);
		
		     $no2=(string)$rs3->fields('no');
		  $no=$no1+$no2;
		
		return $no; 
		   
	}
	function StuAll($conn,$sid)
	{
		$sql="SELECT count(*)  as no FROM V_2010_Section_Student WHERE Section_Id='".$sid."' AND Session_Id='12'";
	    $rs3 = $conn->execute($sql);
		
		     $no=(string)$rs3->fields('no');
		 
		return $no; 
	
		   
	}
	 function GetName($conn,$csf_id)
	{
	$sql="SELECT * FROM V_Section_Subject_Faculty WHERE CSF_Id='".$csf_id."'";
	$rs3 = $conn->execute($sql);
	$name=(string)$rs3->fields('Name');
	$Subject_Code=(string)$rs3->fields('Subject_Code');	
	$value=$name."[".$Subject_Code."]";
		return $value; 
		   
	}
	
	
}

?>