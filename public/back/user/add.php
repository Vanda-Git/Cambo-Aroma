<?php include'../layout/header.php';?>
<?php 
if(isset($_POST["btn_add"])){
    $name = $_POST["txt_name"];
    $gender = $_POST["txt_gender"];
    $username = $_POST["txt_user"];
    $password = md5($_POST["txt_password"]);
    $position = $_POST["txt_position"];
    $note = $_POST["txt_note"];
    $date = date("Y/m/d");
    
    $image = @$_FILES["txt_image"]["name"];
    $upload = 1;
    if($image == ""){
        $image = "blank.png";
        $upload = 0;
    }
    else{
        $image = date("ymdHis")."-".rand(1000,9999).".png";
        $upload = 1;
    }
    $target_file = '../Asset/images/user/' . basename($image);

    if($upload == 1){
        if (move_uploaded_file($_FILES["txt_image"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["txt_image"]["name"])). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }


    $sql = "INSERT INTO tbl_user 
                (
                    us_fullname,
                    us_gen,
                    us_username,
                    us_pass,
                    us_note,
                    us_pos,
                    us_image,
                    date_created
                )
            VALUES 
                (
                    '".$name."',
                    '".$gender."',
                    '".$username."',
                    '".$password."',
                    '".$note."',
                    '".$position."',
                    '".$image."',
                    '".$date."'
                )
            ";
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
            <h1 class="m-0 text-dark">USER</h1>
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
                            <h3 class="card-title">Add New User</h3>
                        </div>
                        <form method='post' enctype="multipart/form-data"> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">FULL NAME <i class="text-danger">*</i> </label>
                                            <input type="text" class="form-control" id="pid" placeholder="Full name" name="txt_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">GENDER <i class="text-danger">*</i></label>
                                            <select name="txt_gender" class="form-control" required id="">
                                                <option value="">Select Item</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">USER NAME <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="pid" placeholder="User Name" name="txt_user" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">PASSWORD <i class="text-danger">*</i></label>
                                            <input type="password" class="form-control" id="pid" placeholder="Password" name="txt_password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">POSITION <i class="text-danger">*</i></label>
                                            <select name="txt_position" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                            <?php
                                                $sql_pos = "SELECT * FROM tbl_position";
                                                $result_pos = $conn->query($sql_pos);
                                                if($result_pos->num_rows>0){
                                                    while($row = $result_pos->fetch_array()){
                                            ?>
                                                    <option value="<?=@$row["pos_id"]?>"><?=@$row["pos_title"]?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">NOTE</label>
                                            <textarea name="txt_note" id="" class="form-control" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Image</label>
                                            <input type="file" class="form-control" name="txt_image">
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
