<?php include'../layout/header.php';?>
<?php 
$id=$_GET["id"];
$sql= "SELECT * FROM tbl_position WHERE pos_id = '".$id."'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_array()){
    $id=$row['pos_id'];
    $title=$row['pos_title'];
    $note=$row['pos_note'];
  }
}
if(isset($_POST["btn_add"])){
    $title = $_POST["txt_title"];
    $note = $_POST["txt_note"];
    $date = date("Y/m/d");
    $sql = "UPDATE tbl_position SET pos_title='$title',pos_note='$note',date_updated='$date' WHERE pos_id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Update Successful");</script>';
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
                            <h3 class="card-title">Posistion</h3>
                        </div>
                        <form method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">Title <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" value="<?=@$title?>" id="pid" placeholder="Position Title" name="txt_title" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="txt_note" id="" class="form-control"><?=@$note?></textarea>
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
