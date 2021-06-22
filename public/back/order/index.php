<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "update orders set status = '0' where id ='".$delete_id."'";
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
      <h2> <i class="fa fa-shopping-basket"></i> Order List</h2>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
          <th >Order Code</th>
          <th >Product Code</th>
          <th >Product Name</th>
          <th >Price($)</th>
          <th >QTY</th>
          <th >Total($)</th>
          <th >Full Name</th>
          <th >Address</th>
          <th >Address on Map</th>
          <th >Order Date</th>
          <th >Invoice</th>
          <th >Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $sql= " select
                        a.id,
                        p.pr_code,
                        p.pr_name,
                        a.price,
                        a.qty,
                        a.total,
                        a.full_name,
                        a.address_detail,
                        a.latitude,
                        a.longitude,
                        a.invoice,
                        a.order_date
                    from orders as a
                    inner join tbl_product p on a.product = p.pr_id where a.status='1'
                  ";
            
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.sprintf('%04d', $row['id']).'</td>
                      <td>'.$row['pr_code'].'</td>
                      <td>'.$row['pr_name'].'</td>
                      <td>'.$row['price'].'</td>
                      <td>'.$row['qty'].'</td>
                      <td>'.$row['total'].'</td>
                      <td>'.$row['full_name'].'</td>
                      <td>'.$row['address_detail'].'</td>
                      <td><a href="https://maps.google.com/maps?q='.$row['latitude'].','.$row['longitude'].'" target="_blank" >Google Map</a></td>
                      <td>'.$row['order_date'].'</td>
                      <td><a href="../images/invoice/'.$row['invoice'].'" target="_blank"><image src="../images/invoice/'.$row['invoice'].'" width="60px" height="60px"></a></td>
                      <td>
                        <a href="index.php?delete_id='.$row['id'].'" class="btn btn-xs btn-danger">Finish</a>
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
