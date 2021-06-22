<?php include'../layout/header.php';?>
<?php 
  if(isset($_POST["btn_add"])){
    $title = $_POST["txt_title"];
    $note = $_POST["txt_note"];
    $sql = "INSERT INTO tbl_category (title,note)
    VALUES ('".$title."', '".$note."')";
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
            <h1 class="m-0 text-dark">Category</h1>
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
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <form role="form" method='post'> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="title">Title <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="title" placeholder="Title" name="txt_title" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" id="note" placeholder="Note" name="txt_note"></textarea>
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
