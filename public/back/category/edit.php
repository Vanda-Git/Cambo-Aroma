<?php include'../layout/header.php';?>
<?php 
$id=$_GET["id"];
$sql= "select * from tbl_category where id='".$id."'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_array()){
    $title=$row['title'];
    $note=$row['note'];
  }
}
  if(isset($_POST["btn_add"])){
    $title = $_POST["txt_title"];
    $note = $_POST["note"];
    $sql = "UPDATE tbl_category SET title='".$title."', note='".$note."'
    WHERE id='".$id."'";
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
                            <h3 class="card-title">Category</h3>
                        </div>
                        <form role="form" method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" placeholder="Title" name="txt_title" value="<?php echo $title;?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" class="form-control" id="note" placeholder="Note"><?php echo $note;?></textarea>
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
