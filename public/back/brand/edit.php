<?php include'../layout/header.php';?>
<?php 
$id=$_GET["id"];
$sql= "select * from tbl_brand where br_id='".$id."'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_array()){
    $code=$row['br_code'];
    $name=$row['br_name'];
    $country=$row['br_country'];
    $note=$row['br_note'];
  }
}
  if(isset($_POST["btn_add"])){
    $code = $_POST["txt_code"];
    $name = $_POST["txt_name"];
    $country = $_POST["txt_country"];
    $note = $_POST["note"];
    $sql = "UPDATE tbl_brand SET br_code='".$code."',br_name='".$name."',br_country='".$country."',br_note='".$note."'
    WHERE br_id='".$id."'";
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
                            <h3 class="card-title">Brand</h3>
                        </div>
                        <form role="form" method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">Brand Code</label>
                                            <input type="text" class="form-control" id="brc" placeholder="Brand ID" name="txt_code" value="<?php echo $code;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pn">Brand Name</label>
                                            <input type="text" class="form-control" id="brn" placeholder="Enter Brand Name" name="txt_name" value="<?php echo $name;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Country</label>
                                            <input type="text" class="form-control" id="brcountry" placeholder="Enter Country" name="txt_country" value="<?php echo $country;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" class="form-control" id="note" placeholder=""><?php echo $note;?></textarea>
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
