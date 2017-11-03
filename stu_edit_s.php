<?php
ini_set('display_errors', 1);
error_reporting(~0);
session_start();
if($_SESSION['id_student'] == "")
{
	echo "<script language=\"JavaScript\">";
	echo "alert('กรุณาลงชื่อเข้าใช้');window.location='index.php';";
	echo "</script>";
	exit();
}
isset($_POST["tel"])?$_POST["tel"]=$_POST["tel"]:$_POST["tel"]=" ";
if(empty($_SESSION['id_student'])){
	$data="กรอกข้อมูลสำคัญไม่ครบ\\n";
	echo "Error";
	echo "<script language=\"JavaScript\">";
	echo "alert(\"$data\");window.location='';";
	echo "</script>";
	exit();
}else{
	$id_student=$_SESSION['id_student'];
	include("connect.php");
	$sql = "UPDATE students SET tel='".$_POST["tel"]."' WHERE id_student = '".$id_student."'";
	$query = mysqli_query($con,$sql);

	if($query) {
		echo "<script language=\"JavaScript\">";
		echo "alert('บันทึกสำเร็จ');window.location='stu_profile.php';";
		echo "</script>";
		exit();
	}else{
		echo "<script language=\"JavaScript\">";
		echo "alert('บันทึกไม่สำเร็จ');window.location='stu_edit.php?id_student=".$id_student."';";
		echo "</script>"; 
		exit();  
	}
	mysqli_close($con);
}
?>
