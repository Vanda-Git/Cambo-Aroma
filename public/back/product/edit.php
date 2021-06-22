<?php include '../layout/header.php'; ?>
<?php
$id = $_GET["id"];
$sql = "select * from tbl_product where pr_id='" . $id . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $pr_code = $row['vendor_product_code'];
        $pr_name = $row['pr_name'];
        $pr_price = $row['pr_price'];
        $pr_expire_date = $row['pr_expire_date'];
        $pr_category = $row['pr_category'];
        $pr_brand = $row['pr_brand'];
        $pr_image = $row['pr_image'];
        $detail = $row['Detail'];
        $pr_unit = $row['unit_id'];
        $pice_per_box = $row["pice_per_box"];
        $capacity = $row["capacity"];
        $remark = $row["remark"];
    }
}
if (isset($_POST["btn_add"])) {
    $code = $_POST["txt_code"];
    $name = $_POST["txt_name"];
    $price = $_POST["txt_price"];
    $expire_date = $_POST['txt_expire_date'];
    $category = $_POST['txt_category'];
    $brand = $_POST['txt_brand'];
    $unit = $_POST['txt_unit'];
    $detail = $_POST['editor1'];
    $pice_per_box = $_POST["txt_p_per_box"];
    $capacity = $_POST["txt_capacity"];
    $remark = $_POST["txt_remark"];

    $image = @$_FILES["txt_image"]["name"];
    $upload = 1;
    if ($image == "") {
        $image = $pr_image;
        $upload = 0;
    } else {
        $image = date("ymdHis") . "-" . rand(1000, 9999) . ".png";
        $upload = 1;
    }
    $target_file = '../Asset/images/product/' . basename($image);

    if ($upload == 1) {
        if (move_uploaded_file($_FILES["txt_image"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["txt_image"]["name"])). " has been uploaded.";
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "UPDATE 
                tbl_product 
            SET 
            vendor_product_code='" . $code . "',
                pr_name='" . $name . "',
                pr_price='" . $price . "',
                pr_expire_date='" . $expire_date . "', 
                pr_category='" . $category . "', 
                pr_brand='" . $brand . "', 
                pr_image='" . $image . "',
                Detail='" . $detail . "',
                pice_per_box='" . $pice_per_box . "',
                capacity='" . $capacity . "',
                remark='" . $remark . "',
                unit_id='" . $unit . "'
            WHERE pr_id='" . $id . "'";
    if ($conn->query($sql) === TRUE) {
        //echo '<script>alert("Update Successful");window.location.href="index.php";</script>';


    } else {
        die("Error: " . $sql . "" . $conn->error);
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
                            <h3 class="card-title">Product</h3>
                        </div>
                        <form role="form" method='post' enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pid">Product Code</label>
                                            <input type="text" class="form-control" id="pid" placeholder="Enter ID" name="txt_code" value="<?php echo $pr_code; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pn">Product Name</label>
                                            <input type="text" class="form-control" id="pn" placeholder="Enter Name" name="txt_name" value="<?php echo $pr_name; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="text" class="form-control" id="price" placeholder="Enter Price" name="txt_price" value="<?php echo $pr_price; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pn">Expire Date</label>
                                            <input type="date" class="form-control" id="ed" placeholder="Enter date" name="txt_expire_date" value="<?php echo date('Y-m-d', strtotime($pr_expire_date)) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select name="txt_category" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                                <?php
                                                $sql_pos = "SELECT * FROM tbl_category";
                                                $result_pos = $conn->query($sql_pos);
                                                if ($result_pos->num_rows > 0) {
                                                    while ($row = $result_pos->fetch_array()) {
                                                ?>
                                                        <option value="<?= @$row["id"] ?>" <?= (@$pr_category == @$row["id"] ? "selected" : "") ?>><?= @$row["title"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Brand</label>
                                            <select name="txt_brand" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                                <?php
                                                $sql_pos = "SELECT * FROM tbl_brand";
                                                $result_pos = $conn->query($sql_pos);
                                                if ($result_pos->num_rows > 0) {
                                                    while ($row = $result_pos->fetch_array()) {
                                                ?>
                                                        <option value="<?= @$row["br_id"] ?>" <?= (@$pr_brand == @$row["br_id"] ? "selected" : "") ?>><?= @$row["br_name"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="brand">Unit <i class="text-danger">*</i></label>
                                            <select name="txt_unit" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                                <?php
                                                $sql_pos = "SELECT * FROM tbl_unit";
                                                $result_pos = $conn->query($sql_pos);
                                                if ($result_pos->num_rows > 0) {
                                                    while ($row = $result_pos->fetch_array()) {
                                                ?>
                                                        <option value="<?= @$row["id"] ?>" <?= (@$pr_unit == @$row["id"] ? "selected" : "") ?>><?= @$row["name"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="p_per_box">Pice Per Box</label>
                                            <input Type="number" name="txt_p_per_box" class="form-control" value="<?= @$pice_per_box ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Capacity</label>
                                            <input Type="text" name="txt_capacity" class="form-control" value="<?= @$capacity ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Remark</label>
                                            <textarea name="txt_remark" id="" class="form-control"><?= @$remark ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pn">Image</label>
                                            <input type="file" class="form-control" id="image" placeholder="Input image" name="txt_image">
                                            <img src="../Asset/images/product/<?= @$pr_image ?>" width="100px" height="100px" alt="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Detail</label>
                                            <textarea name="editor1" id="" class="form-control"><?= @$detail ?></textarea>
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