<?php include'../layout/header.php';?>
<?php
  if(@$_GET['delete_id']!=''){
    $delete_id=$_GET['delete_id'];
    $sql= "DELETE FROM `tbl_product` WHERE pr_id='".$delete_id."'";
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
      <a href="add.php" class="btn btn-primary">Add New Product</a>
      <hr/>
      <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
          <th >Product Code</th>
          <th >Product Name</th>
          <th >Price($)</th>
          <th >Create By</th>
          <th >Expire Date</th>
          <th >Category</th>
          <th >Brand</th>
          <th >Unit</th>
          <th >Image</th>
          <th >Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $sql= "SELECT A.*,B.title,C.br_name,D.us_fullname,E.name AS Unit FROM tbl_product AS A
                  LEFT JOIN tbl_category AS B ON A.pr_category = B.id 
                  LEFT JOIN tbl_brand AS C ON A.pr_brand = C.br_id
                  LEFT JOIN tbl_user AS D ON A.user = D.us_id
                  LEFT JOIN tbl_unit AS E ON A.unit_id = E.id
                  ";
            
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['vendor_product_code'].'</td>
                      <td>'.$row['pr_name'].'</td>
                      <td>'.$row['pr_price'].'</td>
                      <td>'.$row['us_fullname'].'</td>
                      <td>'.date('Y-m-d',strtotime( $row['pr_expire_date'])).'</td>
                      <td>'.$row['title'].'</td>
                      <td>'.$row['br_name'].'</td>
                      <td>'.$row['Unit'].'</td>
                      <td><image src="../Asset/images/product/'.$row['pr_image'].'" width="60px" height="60px" ></td>
                      <td>
                      <a href="edit.php?id='.$row['pr_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
                      <a href="index.php?delete_id='.$row['pr_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>Delete</a>
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
