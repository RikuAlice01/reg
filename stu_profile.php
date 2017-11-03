<<?php
include("panel.php");
ini_set('display_errors', 1);
error_reporting(~0);
include("connect.php");
$id_student = null;
if($_SESSION['id_student'])
{
	$id_student = $_SESSION['id_student'];
}
include("connect.php");
$sql = "SELECT * FROM students WHERE id_student = '".$id_student."' ";
$query = mysqli_query($con,$sql);
$result=mysqli_fetch_array($query,MYSQLI_ASSOC);
mysqli_close($con);
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<br><br><br>
	</div>
	<div class="row">
		<div class="col-lg-12" align="center">
			<br>
			<h3 class="page-header">ประวัตินักเรียน</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-6">
						<form role="form" action="stu_edit.php" method="post">
							<div class="form-group">
								<label>รหัสนักเรียน</label>
								<?php echo $result["id_student"];?>
							</div>
							<div class="form-group">
								<label>ชื่อ</label> <?php echo $result["titlename"] .$result["s_firstname"]." ".$result["s_lastname"];?>
							</div>		
							<div class="form-group">
								<label>ชั้นปีที่</label>
								<?php echo $result["class"];?>
							</div>
							<div class="form-group">
								<label>เบอร์ติดต่อ</label>
								<?php 
								if($result["tel"]==""){
									echo " - ";
								}else{
									echo $result["tel"];
								}
								?>
							</div>
							<button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
					</form>
					</div>
					<div class="col-md-6">

						<img src="qrs/qr<?php echo hexdec($result["id_student"]);?>.png">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
