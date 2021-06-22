<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "DELETE FROM tbl_brand WHERE br_id='".$delete_id."'";
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
      <a href="add.php" class="btn btn-primary">Add New Brand</a>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Brand Code</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Brand Name</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Country</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Note</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT * FROM tbl_brand";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['br_code'].'</td>
                      <td>'.$row['br_name'].'</td>
                      <td>'.$row['br_country'].'</td>
                      <td>'.$row['br_note'].'</td>
                      <td>
                      <a href="edit.php?id='.$row['br_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
                      <a href="index.php?delete_id='.$row['br_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>Delete</a>
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
