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
$id_student = null;
include("connect.php");
if(empty($_POST["oldpassword"])||empty($_POST["newpassword"])||empty($_POST["renewpassword"])){
	echo "<script language=\"JavaScript\">";
	echo "alert('กรอกข้อมูลไม่ครบ');window.location='change_password.php';";
	echo "</script>";
	exit();
}else{
	if($_POST["newpassword"]!=$_POST["renewpassword"]){
		echo "<script language=\"JavaScript\">";
		echo "alert('รหัสผ่านใหม่ไม่ตรงกัน');window.location='change_password.php';";
		echo "</script>";
		exit();
	}else{
		$oldpassword = mysqli_real_escape_string($con,md5($_POST['oldpassword']));
		$strSQL = "SELECT * FROM students WHERE  id_student = '".$_SESSION['id_student']."'and password = '".$oldpassword."';";
		$objQuery = mysqli_query($con,$strSQL);
		$objResult = mysqli_fetch_array($objQuery);
		if(!$objResult)
		{
			$data="รหัสผ่านไม่ถูกต้อง\\n";
			echo "<script language=\"JavaScript\">";
			echo "alert(\"$data\");window.location='change_password.php';";
			echo "</script>";
			exit();
		}else{
			$newpassword = mysqli_real_escape_string($con,md5($_POST['newpassword']));	
			$id_student=$_SESSION['id_student'];
			$sql = "UPDATE students SET password='".$newpassword."' WHERE id_student = '".$id_student."';";
			$query = mysqli_query($con,$sql);
			if($query) {
				echo "<script language=\"JavaScript\">";
				echo "alert('บันทึกสำเร็จ');window.location='logout.php';";
				echo "</script>";
				exit();
			}else{
				echo "<script language=\"JavaScript\">";
				echo "alert('บันทึกไม่สำเร็จ');window.location='index.php';";
				echo "</script>";
				exit();   
			}
		mysqli_close($con);
		}

	}
}

?>