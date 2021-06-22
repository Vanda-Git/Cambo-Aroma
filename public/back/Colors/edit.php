<?php include '../layout/header.php'; ?>
<?php
if (isset($_POST["btn_add"])) {
    $color = $_POST["txt_color"];
    $code = $_POST["txt_code"];
    $sql_update = "update d_master set caption = '$color' where cd_name='COLOR' AND code = '$code'";
    if($conn->query($sql_update) === TRUE){
        
    }
}

$id = $_GET["id"];
$sql = "SELECT code,cd_name,caption FROM d_master where cd_name='COLOR' AND code = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $code = $row['code'];
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
                            <h3 class="card-title">Color Update</h3>
                        </div>
                        <form method='post' enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pid">Colors code <i class="text-danger">Please put properly color!</i></label>
                                            <input type="text" name="txt_color" value="<?=$caption?>" class="form-control">
                                            <input type="hidden" name="txt_code" value="<?=$code?>">
                                        </div>
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