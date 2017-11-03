<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
if(empty($_SESSION['id_student']))
{
  echo "<script language=\"JavaScript\">";
  echo "alert('กรุณาลงชื่อเข้าใช้');window.location='index.php';";
  echo "</script>";
  exit();
}else{
  ini_set('display_errors', 1);
  error_reporting(~0);

  isset($_POST["sub_id"])?$sub_id=$_POST["sub_id"]:$sub_id="";
  if(empty($sub_id)){
    $data="ไม่สามารถลงทะเบียนได้\\n";
    echo "Error";
    echo "<script language=\"JavaScript\">";
    echo "alert(\"$data\");window.location='stu_reg.php';";
    echo "</script>";
    exit();
  }else{
    include("connect.php");
              $sql = "SELECT * FROM regit WHERE sub_id = '".$sub_id."' AND id_student ='".$_SESSION["students_id"]."';";
                    $objQuery = mysqli_query($con,$sql);
                    if(mysqli_fetch_array($objQuery)){
                    echo "<script language=\"JavaScript\">";
                    echo "alert('ลงทะเบียนอยู่แล้ว');window.location='stu_reg.php';";
                    echo "</script>";
                    exit();
                    }
              }

              $sql = "SELECT * FROM subjects WHERE s_id = '".$sub_id."';";
              if(!$sub_id){
                echo "ไม่พบรายวิชา";
              }else{
                    $objQuery = mysqli_query($con,$sql);
                    $objResult = mysqli_fetch_array($objQuery); 
                    $u_id=$objResult["u_id"];              
              }         
    $sql = "insert into regit(u_id,sub_id,id_student) values ('".$u_id."', '".$sub_id."', '".$_SESSION["students_id"]."');";
    $query = mysqli_query($con,$sql) or die(mysql_error());
    if($query) {
      echo "<script language=\"JavaScript\">";
      echo "alert('ลงทะเบียนสำเร็จ');window.location='stu_reg.php';";
      echo "</script>";
      exit();
    }else{
      echo "<script language=\"JavaScript\">";
      echo "alert('ลงทะเบียนไม่สำเร็จ');window.location='stu_reg.php';";
      echo "</script>";
      exit();
    }
    mysqli_close($con);
  }
?>

