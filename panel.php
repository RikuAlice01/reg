<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
if($_SESSION['id_student'] == "")
{
	echo "<script language=\"JavaScript\">";
	echo "alert('กรุณาลงชื่อเข้าใช้');window.location='index.php';";
	echo "</script>";
	exit();
}else{
include("connect.php");
$strSQL = "SELECT * FROM students WHERE id_student = '".$_SESSION['id_student']."' ";
$objQuery = mysqli_query($con,$strSQL);
$objResult = mysqli_fetch_array($objQuery);
mysqli_close($con);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> ระบบลงทะเบียนเรียน </title>
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/lumino.glyphs.js"></script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="indexs.php"><span>ระบบลงทะเบียนเรียน</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $objResult["id_student"]." : ".$objResult["s_firstname"]." ".$objResult["s_lastname"];?></a>
					</li>
				</ul>
			</div>				
		</div>
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li><a href="indexs.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg> หน้าแรก</a></li>
			<li><a href="stu_reg.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-plus-sign"></use></svg>ลงทะเบียนรายวิชา</a></li>
			<li><a href="stu_history.php"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"></use></svg> ประวัติการเข้าเรียน</a></li>
			<li><a href="stu_profile.php"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"></use></svg> ประวัตินักเรียน</a></li>
			<li><a href="change_password.php"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"></use></svg>เปลี่ยนรหัสผ่าน</a></li>
			<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> ออกจากระบบ</a></li>
			<li role="presentation" class="divider"></li>
		</ul>
	</div>
</body>
</html>
<?php
}
?>