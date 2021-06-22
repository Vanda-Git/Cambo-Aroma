<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "DELETE FROM tbl_position WHERE pos_id='".$delete_id."'";
    $conn->query($sql);
  }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <br/>
      <a href="add.php" class="btn btn-primary"> <i class="fa fa-plus"></i> New Record</a>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Color</th>
        <th>Action</th>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT code,cd_name,caption,remark FROM d_master where cd_name='COLOR'";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['code'].'</td>
                      <td>'.$row['cd_name'].' '.$row["remark"].'</td>
                      <td>
                        <div style="background-color:'.$row["caption"].';width:100px;height:40px;"></div>
                      </td>
                      <td>
                      <a href="edit.php?id='.$row['code'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
                      </td>
                    </tr>';
              }
            }
          ?>
        </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <?php include'../layout/footer.php';?>
