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
      <!-- <a href="add.php" class="btn btn-primary">Add New Product</a> -->
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
                      <td tabindex="0" class="sorting_1">'.$row['pr_code'].'</td>
                      <td>'.$row['pr_name'].'</td>
                      <td>'.$row['pr_price'].'</td>
                      <td>'.$row['us_fullname'].'</td>
                      <td>'.date('Y-m-d',strtotime( $row['pr_expire_date'])).'</td>
                      <td>'.$row['title'].'</td>
                      <td>'.$row['br_name'].'</td>
                      <td>'.$row['Unit'].'</td>
                      <td><image src="../images/product/'.$row['pr_image'].'" width="60px" height="60px" ></td>
                      <td>
                        <input type="checkbox" '.($row["Isdiscount"]=="1"?"checked":"").' id="chk_dis'.$row['pr_id'].'" onchange="fun_discount(this,'.$row['pr_id'].')"/> <label for="chk_dis'.$row['pr_id'].'">Discount</label>
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
  <script>
    function fun_discount(e,id){
      var Ischeck = $(e).prop("checked");
      var product_id = id;
      var dis_percentage = "";
      if(Ischeck == true){
        dis_percentage = prompt("Input Discount Percentage","20");
      }
      else{
        dis_percentage = 0;
      }
      if(isNaN(dis_percentage)){
          alert("Discount must be a Number");
          $(e).prop("checked", false);
      }else{
          var Ischeck = $(e).prop("checked");
          $.post("ajx_discount.php",
          {
              id: product_id,
              per: dis_percentage,
              ischeck: Ischeck
          },
          function(data, status){
            if(data == "1"){
              alert("Complete!");
            }
            else{
              alert("Error!");
            }
          });
      }
    }
  </script>
  <?php include'../layout/footer.php';?>
