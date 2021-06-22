<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "DELETE FROM tbl_stock_out WHERE id='".$delete_id."'";
    $conn->query($sql);
  }
?>
<style>
.btn-disabled{
  cursor:not-allowed;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <br/>
      <a href="add.php" class="btn btn-primary"> <i class="fa fa-plus"></i> New Record Stock In</a>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
          <th>Invoice Number</th>
          <th>Total Payment</th>
          <th>Date</th>
          <th>Note</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT * FROM tbl_stock_out";
            
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['code'].'</td>
                      <td>'.$row['total_paid'].'</td>
                      <td>'.date('Y-m-d',strtotime( $row['create_date'])).'</td>
                      <td>'.$row['note'].'</td>
                      <td>
                        <a href="javascript:void(0)" title="disable" class="btn btn-warning btn-xs btn-disabled" disabled><i class="fa fa-edit"></i> Edit</a>
                        <a href="index.php?delete_id='.$row['id'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                        <button type="button" class="btn btn-info btn-xs" onclick="show_modal('.$row['id'].')" ><i class="fa fa-info"></i> Show</button>
                        <a class="btn btn-xs btn-success" href="print.php?id='.$row['id'].'" target="_blank">Print <i class="fa fa-print"></i></a>  
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content" style="height:300px;padding:0px;">
        <div class="modal-body" style="height:300px;padding:0px;">
          <iframe src="gg" id="myframe" frameborder="0" style="width:100%;height:300px;"></iframe>
        </div>
      </div>
      
    </div>
  </div>
  <?php include'../layout/footer.php';?>
  <script>
    function show_modal(id){
      $('#myframe').attr('src', "info.php?id="+id);
      $('#myModal').modal('show');
    }
  </script>
