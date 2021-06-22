<?php include'../layout/header.php';?>
<?php 
  if(isset($_POST["btn_sell"])){
    $cus_name = $_POST["cus"];
    $total = $_POST["totaldollar"];
    $receive = $_POST["recievedollar"] + ($_POST["recievekhmer"]/4000);
        $sql = "INSERT INTO tbl_sale (cus_id,total,receivein)
        VALUES ('".$cus_name."', '".$total."','".$receive."')";
        if ($conn->query($sql) === TRUE) {
          
          $last_id = $conn->insert_id;
          
          $id = $_POST["id"];
          $qty = $_POST["qty"];
          $price = $_POST["price"];
          $sql2 = "INSERT INTO tbl_sale_detail(sale_id,pr_id,qty,pr_price) VALUES ";
          foreach($id as $key=>$val){
            $sql2 .= "('".$last_id."','".$val."','".$qty[$key]."','".$price[$key]."'),";
          }
          
          $sql2 = rtrim($sql2,",") . ";";
          if ($conn->query($sql2) === TRUE) {
            echo '<script>alert("Sell Successful");</script>';
            
          }else {
            die( "Error: " . $sql2 . "" . $conn->error);
          } 
        }
        else {
          die( "Error: " . $sql . "" . $conn->error);
        }
  }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
    <form action="" method="POST">
      <div class="row">
        <div class="col-sm-3">
          <label for="">Product</label>
            <select class="form-control select2bs4 txt_product" style="width: 100%;">
              <option value="">Select Item</option>
              <?php
                $sql= "select * from tbl_product";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                  while($row=$result->fetch_array()){
                    echo '<option value="'.$row['pr_id'].'">'.$row['pr_name'].'</option>';
                  }
                }
              ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="">&nbsp;</label>
            <br/>
            <button class="btn btn-primary btn_add" type="button">select</button>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
            <label>Customer</label>
            <select class="form-control select2bs4 txt_product" name="cus" style="width: 100%;">
              <option value="">Select Customer</option>
              <?php
                $sql= "select * from tbl_customer";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                  while($row=$result->fetch_array()){
                    echo '<option value="'.$row['cus_id'].'">'.$row['cus_name'].'</option>';
                  }
                }
                ?>
            </select>
            </div>
        </div>
          <div class="col-sm-12" style="height:350px;overflow:scroll;">
            <table class="tbl_sale" width="100%" border=1>
                <tr>
                  <th style="align:center;">Nº</th>
                  <th style="align:center;">Product Name</th>
                  <th style="width:8%; align:center;">Quantity</th>
                  <th style="align:center;">Price</th>
                  <th style="align:center;">Amount</th>
                  <th style="align:center;">Action</th>
                </tr>            
            </table>
          </div>
      </div>
      <br/>

      <div class="row">
                <label for="">&nbsp;&nbsp;&nbsp;</label>
                <label for="">Total</label>
                <div class="col-sm-2">
                  <input type="text" name="totaldollar" id="totaldollar" class="txt_total_usd form-control" value="0" readonly>
                </div>
                <label for="">$</label>
                <div class="col-sm-1">
                </div>
                <label for="">Recieve</label>
                <div class="col-sm-2">
                  <input type="text"class="form-control" id="recievedollar" name="recievedollar" value="0" onkeyup="calculate_return()">
                </div>
                <label for="">$</label>
                <div class="col-sm-1">
                </div>
                <label for="">Cash back</label>
                <div class="col-sm-2">
                <input type="text" name="exchangedollar" class="exchangedollar form-control" readonly>
                </div>
                <label for="">$</label>
                <div style="margin-left:80px;">
                  <button type="submit" class="btn btn-primary btn_sell" name="btn_sell">Sell</button>
                </div>

      </div>
      <br/>
      <div class="row">
                <label for="">&nbsp;&nbsp;&nbsp;</label>
                <label for="">Total</label>
                <div class="col-sm-2">
                  <input type="text" name="totalkhmer" class="txt_total_khr form-control" value="0" readonly>
                </div>
                <label for="">៛</label>
                <div class="col-sm-1">
                </div>
                <label for="">Recieve</label>
                <div class="col-sm-2">
                  <input type="text"class="form-control" id="recievekhmer" name="recievekhmer"value="0" onkeyup="calculate_return()">
                </div>
                <label for="">៛</label>
                <div class="col-sm-1">
                </div>
                <label for="">Cash back</label>
                <div class="col-sm-2">
                <input type="text" name="exchangekhmer" class="exchangekhmer form-control" readonly>
                </div>
                <label for="">៛</label>
      </div>
      </form>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <?php include'../layout/footer.php';?>
  <script src="sale.js"></script>
