<?php include '../layout/header.php'; ?>
<?php
if (isset($_POST["btn_add"])) {
    $code = $_POST["txt_code"];
    $name = $_POST["txt_name"];
    $price = $_POST["txt_price"];
    $expire = $_POST["txt_date"];
    $category = $_POST["txt_category"];
    $brand = $_POST["txt_brand"];
    $detail = $_POST["editor1"];
    $unit_id = $_POST["txt_unit"];
    $pice_per_box = $_POST["txt_p_per_box"];
    $capacity = $_POST["txt_capacity"];
    $remark = $_POST["txt_remark"];
    $user = $_SESSION["User"]["us_id"];

    $image = @$_FILES["txt_image"]["name"];
    $upload = 1;
    if ($image == "") {
        $image = "blank.png";
        $upload = 0;
    } else {
        $image = date("ymdHis") . "-" . rand(1000, 9999) . ".png";
        $upload = 1;
    }
    $target_file = '../Asset/images/product/' . basename($image);

    if ($upload == 1) {
        if (move_uploaded_file($_FILES["txt_image"]["tmp_name"], $target_file)) {
            //  echo "The file ". htmlspecialchars( basename( $_FILES["txt_image"]["name"])). " has been uploaded.";
        } else {
            // echo "Sorry, there was an error uploading your file.";
        }
    }


    $sql = "INSERT INTO tbl_product (vendor_product_code,pr_name,pr_price,pr_expire_date,pr_category,pr_brand, pr_image,user,Detail,unit_id,remark,pice_per_box,capacity)
    VALUES ('" . $code . "', '" . $name . "', '" . $price . "', '" . $expire . "', '" . $category . "','" . $brand . "', '" . $image . "', '" . $user . "', '" . $detail . "', '" . $unit_id . "','".$remark."','".$pice_per_box."','".$capacity."')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Create Successful");</script>';
    } else {
        die("Error: " . $sql . "" . $conn->error);
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
                    <h1 class="m-0 text-dark">Product</h1>
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
                            <h3 class="card-title">Add New Product</h3>
                        </div>
                        <form role="form" method='post' enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pid">Product Code <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="pid" placeholder="Product Code" name="txt_code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pn">Product Name <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="pn" placeholder="Product Name" name="txt_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Price <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="price" placeholder="Product price" name="txt_price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Expire Date <i class="text-danger">*</i></label>
                                            <input type="date" class="form-control" id="date" placeholder="Product date" name="txt_date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pid">Category <i class="text-danger">*</i></label>
                                            <select name="txt_category" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                                <?php
                                                $sql_pos = "SELECT * FROM tbl_category";
                                                $result_pos = $conn->query($sql_pos);
                                                if ($result_pos->num_rows > 0) {
                                                    while ($row = $result_pos->fetch_array()) {
                                                ?>
                                                        <option value="<?= @$row["id"] ?>"><?= @$row["title"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="brand">Brand <i class="text-danger">*</i></label>
                                            <select name="txt_brand" class="form-control" id="" required="">
                                                <option value="">Select Item</option>
                                                <?php
                                                $sql_pos = "SELECT * FROM tbl_brand";
                                                $result_pos = $conn->query($sql_pos);
                                                if ($result_pos->num_rows > 0) {
                                                    while ($row = $result_pos->fetch_array()) {
                                                ?>
                                                        <option value="<?= @$row["br_id"] ?>"><?= @$row["br_name"] ?></option>
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
                                                        <option value="<?= @$row["id"] ?>"><?= @$row["name"] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Image</label>
                                            <input Type="file" name="txt_image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="p_per_box">Pice Per Box</label>
                                            <input Type="number" name="txt_p_per_box" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Capacity</label>
                                            <input Type="text" name="txt_capacity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Remark</label>
                                            <textarea name="txt_remark" id="" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Detail</label>
                                            <textarea name="editor1" id="" class="form-control"></textarea>
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