<?php include'../layout/header.php';?>
<?php 
$id=$_GET["id"];
$sql= "SELECT * FROM tbl_user WHERE us_id = '".$id."'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_array()){
    $name=$row['us_fullname'];
    $gender=$row['us_gen'];
    $user=$row['us_username'];
    $password=$row['us_pass'];
    $position=$row['us_pos'];
    $note=$row['us_note'];
    $v_image=$row['us_image'];
  }
}

if(isset($_POST["btn_add"])){
    $name = $_POST["txt_name"];
    $gender = $_POST["txt_gender"];
    $username = $_POST["txt_user"];
    $position = $_POST["txt_position"];
    $note = $_POST["txt_note"];
    $date = date("Y/m/d");

    $image = @$_FILES["txt_image"]["name"];
    $upload = 1;
    if($image == ""){
        $image = $v_image;
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


    $sql = "UPDATE tbl_user SET
                us_fullname='".$name."',
                us_gen = '".$gender."',
                us_username = '".$username."',
                us_note = '".$note."',
                us_pos = '".$position."',
                us_image = '".$image."',
                date_created = '".$date."'
            WHERE us_id = '".$id."'
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User</h3>
                        </div>
                        <form method='post' enctype="multipart/form-data"> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">FULL NAME <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="pid" placeholder="Full name" value="<?=@$name?>" name="txt_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">GENDER <i class="text-danger">*</i></label>
                                            <select name="txt_gender" class="form-control" required id="">
                                                <option value="">Select Item</option>
                                                <option value="MALE" <?=@$gender=="MALE"?"selected":""?>>Male</option>
                                                <option value="FEMALE" <?=@$gender=="MALE"?"":"selected"?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="pid">USER NAME <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="pid" placeholder="User Name" value="<?=@$user?>" name="txt_user" required>
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
                                                    <option value="<?=@$row["pos_id"]?>" <?=(@$position==@$row["pos_id"]?"selected":"")?>><?=@$row["pos_title"]?></option>
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
                                            <textarea name="txt_note" id="" class="form-control" placeholder="Note"><?=@$note?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="note">Image</label>
                                            <input type="file" class="form-control" name="txt_image">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <img src="../images/user/<?=@$v_image?>" width="100px" height="100px" alt="">
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
