<?php include'../layout/header.php';?>
<?php 
$id=$_GET["id"];
$sql= "select * from tbl_customer where cus_id='".$id."'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_array()){
    $cus_name=$row['cus_name'];
    $cus_num=$row['cus_num'];
    $cus_add=$row['cus_add'];
    $cus_note=$row['cus_note'];
    $register_date = $row["register_date"];
  }
}
  if(isset($_POST["btn_add"])){
    $cname = $_POST["txt_name"];
    $cnum = $_POST["txt_num"];
    $cadd = $_POST["txt_add"];
    $cnote = $_POST["comment"];
    $rdate = $_POST["txt_date"];

    $sql = "UPDATE tbl_customer SET cus_name='".$cname."',cus_num='".$cnum."',cus_add='".$cadd."', register_date='".$rdate."' ,cus_note='".$cnote."'
    WHERE cus_id='".$id."'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Update Successful");window.location.href="index.php";</script>';
    } else {
        die( "Error: " . $sql . "" . $conn->error);
    }
  }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Customer</h3>
                        </div>
                        <form role="form" method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="name">Customer Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="" name="txt_name" value="<?php echo $cus_name;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="add">Address</label>
                                            <input type="text" class="form-control" id="add" placeholder="" name="txt_add" value="<?php echo $cus_add;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="pn">Phone Number</label>
                                            <input type="text" class="form-control" id="pn" placeholder="" name="txt_num" value="<?php echo $cus_num;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="add">Register Date</label>
                                            <input type="date" class="form-control" id="add" placeholder="Tnol Beak" name="txt_date" value="<?php echo $register_date;?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="comment" class="form-control" id="note" placeholder=""><?php echo $cus_note;?></textarea>
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
