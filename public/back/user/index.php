<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "DELETE FROM tbl_user WHERE us_id='".$delete_id."'";
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
        <tr role="row">
          <th >Nº</th>
          <th >FULL NAME</th>
          <th >GENDER</th>
          <th >USER NAME</th>
          <th >NOTED</th>
          <th >POSITION</th>
          <th >IMAGE</th>
          <th >DATE</th>
          <th >ACTION</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT A.*,B.pos_title FROM tbl_user AS A
                  INNER JOIN tbl_position AS B ON A.us_pos = B.pos_id ";
            $result=$conn->query($sql);
            $i = 1;
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.($i++).'</td>
                      <td>'.$row['us_fullname'].'</td>
                      <td>'.$row['us_gen'].'</td>
                      <td>'.$row['us_username'].'</td>
                      <td>'.$row['us_note'].'</td>
                      <td>'.$row['us_pos'].'</td>
                      <td><image src="../Asset/images/user/'.$row['us_image'].'" width="60px" height="60px" ></td>
                      <td>'.$row['DATE_CREATED'].'</td>
                      <td>
                      <a href="edit.php?id='.$row['us_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
                      <a href="index.php?delete_id='.$row['us_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>Delete</a>
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
