
<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $value = $_GET["value"];
    $sql= "update d_master set status = '$value' where cd_name='SLIDE_SHOW_IMAGE' and code='$delete_id' ";
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
      <a class="btn btn-primary" href="javascript:void(0)"> Slide Show Images</a>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Code</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Caption</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Action</th>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT code,cd_name,caption,status FROM d_master where cd_name='SLIDE_SHOW_IMAGE'";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['code'].'</td>
                      <td>'.$row['cd_name'].'</td>
                      <td><img src="../../images/'.$row['caption'].'" width="100px"/></td>
                      <td>
                      <a href="edit.php?id='.$row['code'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
                      <a href="index.php?delete_id='.$row['code'].'&&value='.($row['status']=='1'?'0':'1').'" class="btn btn-'.($row['status']=='1'?'success':'danger').' btn-xs">
                        <i class="fa fa-remove"></i>
                        '.($row['status']=='1'?'Active':'Disabled').'
                      </a>
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
