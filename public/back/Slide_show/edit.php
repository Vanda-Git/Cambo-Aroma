<?php include '../layout/header.php'; ?>
<?php
if (isset($_POST["btn_add"])) {
    $title = $_FILES["txt_file"]["name"];
    $name = $_POST["txt_img_name"];
    $target_file = "../../images/".$name;
    if(move_uploaded_file($_FILES["txt_file"]["tmp_name"], $target_file)) {
        echo "Success";
    } else {

    }
}

$id = $_GET["id"];
$sql = "SELECT code,cd_name,caption FROM d_master where cd_name='SLIDE_SHOW_IMAGE' and code = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $code = $row['code'];
        $cd_name = $row['cd_name'];
        $caption = $row['caption'];
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
                            <h3 class="card-title">Image Update</h3>
                        </div>
                        <form method='post' enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pid">Image <i class="text-danger">*</i></label>
                                            <input type="file" name="txt_file" class="form-control">
                                            <input type="hidden" name="txt_img_name" value="<?=$caption?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <img src="../../images/<?= $caption ?>" alt="" width="100%">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btn_add">Save</button>
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
<?php include '../layout/footer.php'; ?>