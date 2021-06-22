<?php include'../layout/header.php';?>
<?php 
  if(isset($_POST["btn_add"])){
    $cname = $_POST["txt_name"];
    $cnum = $_POST["txt_num"];
    $cadd = $_POST["txt_add"];
    $cnote = $_POST["comment"];
    $rdate = $_POST["txt_date"];
    $sql = "INSERT INTO tbl_customer (cus_name,cus_num,cus_add,register_date,cus_note)
    VALUES ('".$cname."', '".$cnum."', '".$cadd."','".$rdate."','".$cnote."')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Create Successful");</script>';
    } else {
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
            <h1 class="m-0 text-dark">Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Customer</h3>
                        </div>
                        <form role="form" method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">Customer Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Customer's Name" name="txt_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="add">Address</label>
                                            <input type="text" class="form-control" id="add" placeholder="Tnol Beak" name="txt_add" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" placeholder="000-000-000" name="txt_num" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="add">Register Date</label>
                                            <input type="date" onload="getDate()" class="form-control" id="add" placeholder="Tnol Beak" name="txt_date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="comment" class="form-control" id="note" placeholder="Customer Discription" name="txt_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_add">Save</button >
                                <a href="index.php" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <?php include'../layout/footer.php';?>
