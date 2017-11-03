<?php
session_start();
include("connect.php");
$usernamein = mysqli_real_escape_string($con,$_POST['txtUsername']);
$passwordin = mysqli_real_escape_string($con,md5($_POST['txtPassword']));
$strSQL = "SELECT * FROM students WHERE id_student = '".$usernamein."' and password = '".$passwordin."'";
$objQuery = mysqli_query($con,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
if(!$objResult)
{
	$data="ชื่อผู้ใช้งานหรือรหัสไม่ถูกต้อง\\n";
	echo "<script language=\"JavaScript\">";
	echo "alert(\"$data\");window.location='index.php';";
	echo "</script>";
	exit;
}
else
{
	$_SESSION["students_id"] = $objResult["id_stu"];
	$_SESSION["id_student"] = $objResult["id_student"];
	if($_SESSION["id_student"] != "")
	{
		session_write_close();	
		header("location:indexs.php");
	}else{
	session_write_close();
		header("location:index.php");
	}
	
}
mysqli_close($con);
?>