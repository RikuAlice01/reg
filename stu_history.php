<?php
  include("panel.php");
  isset( $_POST['search'])?$search=$_POST['search']:$search='';  
  include("connect.php");
  $sql = "SELECT * FROM regit WHERE id_student = '".$_SESSION['students_id']."';";
  ?>
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
     <div class="col-lg-12" align="center">
       <br><br><br><br>
       <h3 class="page-header">ประวัติการเข้าเรียน</h3>
     </div>
     <form role="form" action="stu_history.php" method="post">
       <div class="col-lg-12" align="center">
        เลือกวิชา :
        <select name="search">
        <?php
        $query = mysqli_query($con,$sql);
        while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
          $sqls = "SELECT s_name,s_number FROM subjects WHERE s_id = '".$result['sub_id']."';";
          $objQuery = mysqli_query($con,$sqls);
          $objResult = mysqli_fetch_array($objQuery);
          ?>
           <option value="<?php echo $result["o_id"] ?>"><?php echo $objResult["s_number"]." ".$objResult["s_name"];?></option>
          <?php
        }
        ?>
        </select>
        <button type="submit" class="btn btn-primary">ค้นหา</button>
        <br><br>
       </div>
     </form> 
   </div>
   <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
       <div class="panel-body">
       <?php
        $sql = "SELECT * FROM infos WHERE o_id = ".$search." ORDER BY i_day ASC";
        $query = mysqli_query($con,$sql);
        if(!$query){
          echo "<div align='center'> ไม่พบข้อมูล</div>";
        }else{
          ?>
        <table width="1020" border="1" align="center">
         <tr>
          <center>
            <th><div align="center"> วัน</div></th>
            <th><div align="center"> เวลาเข้าเรียน</div></th>
            <th><div align="center"> คาบเรียน</div></th>
          </center>
        </tr>
        <?php
        while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
          ?>
          <tr>
            <td><div align="center"><?php echo $result["i_day"]; ?></div></td>
            <td><div align="center"><?php echo $result["checktime"]; ?></div></td>
            <td><div align="center"><?php echo $result["time"]; ?></div></td>
          </tr>
     <?php
        }
        ?>
        </table>
    </div>
  </div>
</div>
</div>
<?php }
mysqli_close($con);
 ?>
</body>
</html>