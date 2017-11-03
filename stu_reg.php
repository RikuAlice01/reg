<?php
include("panel.php");
isset( $_POST['search'])?$search=$_POST['search']:$search=''; 
isset( $_POST['s_id'])?$s_id=$_POST['s_id']:$s_id=''; 
isset( $_POST['sub_id'])?$sub_id=$_POST['sub_id']:$sub_id=''; 
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<br><br><br>
	</div>
	<div class="row">
		<div class="col-lg-12" align="center">
			<br>
			<h3 class="page-header">ลงทะเบียนวิชาเรียน</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form role="form" action="stu_reg.php" method="post">	
						<div class="col-md-6">
							ค้นหา
							<input name="search" autocomplete="off" class="form-control">
						</form>		
						<?php
						include("connect.php");
						if($search!=''){
							$sql = "SELECT * FROM subjects WHERE s_number LIKE '%".$search."%' OR s_name LIKE '%".$search."%';";
							$query = mysqli_query($con,$sql);
							if(!$query){
								echo "ไม่พบรายวิชา";
							}else{
								?>
								<br>
								<table width="700" border="1" align="center">
									<tr>
										<center>
											<th><div align="center"> รหัสวิชา</div></th>
											<th><div align="center"> ชื่อวิชา</div></th>
											<th><div align="center"> ลงทะเบียน</div></th>
										</center>
									</tr>
									<?php
									if(!empty($search)){
									while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
									{
										?>
										<tr>
											<td><div align="center"><?php echo $result["s_number"]; ?></div></td>
											<td><div align="center"><?php echo $result["s_name"]; ?></div></td>
											<td>
												<div align="center">
													<form role="form" action="stu_reg.php" method="post">	
														<input type="hidden" name="sub_id" value='<?php echo $result["s_id"];?>'>
														<input type="hidden" name="search" value='<?php echo $search;?>'>
														<button type="submit" class="btn btn-primary">ลงทะเบียน</button>
													</form>
												</div>
											</td>
										</tr>
										<?php
									}

									?>
								</table>	
								<?php
								}
							}
						}
						?>
					</div>	
					<?php 
						if($search!=''){
							$sqls = "SELECT * FROM subjects WHERE s_id = '".$sub_id."';";
							$querys = mysqli_query($con,$sqls);
							if(!$query){

								echo "ไม่พบรายวิชา";

							}else{
					          $objQuery = mysqli_query($con,$sqls);
					          $objResult = mysqli_fetch_array($objQuery);								
							}
					?>
					<form role="form" action="stu_reg_s.php" method="post">		
						<div class="col-md-6">	
							<div class="form-group">
								<label>วิชาที่จะลงทะเบียน</label>
								<input name="subject"  placeholder='<?php echo $objResult["s_name"];?>' class="form-control" disabled>
							</div>
							<div class="form-group">
					<?php 
						if($search!=''){
							$sqls = "SELECT * FROM user WHERE u_id = '".$objResult["u_id"]."';";
							$querys = mysqli_query($con,$sqls);
							if(!$query){
								echo "ไม่พบรายวิชา";
							}else{
					          $objQuery = mysqli_query($con,$sqls);
					          $objResult = mysqli_fetch_array($objQuery);								
							}
						}
					?>
								<label>ผู้สอน</label>
								<input type="text" name="s_name" placeholder='<?php echo $objResult["titlename"].''.$objResult["u_firstname"].' '.$objResult["u_lastname"];?>' class="form-control" disabled>
								<input type="hidden" name="sub_id" value='<?php echo $sub_id;?>'>
							</div>
							<button type="submit" class="btn btn-primary">ยืนยัน</button>
							<button type="reset" class="btn btn-default">ยกเลิก</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php }
mysqli_close($con);
 ?>
</body>
</html>
