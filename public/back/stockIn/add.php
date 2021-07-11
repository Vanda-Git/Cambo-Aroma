<?php include'../layout/header.php';?>
<?php 
  if(isset($_POST["btn_save"])){
    $code = @$_POST["txt_import_code"];
    $paid = @$_POST["txt_total_paid"];
    $user = @$_SESSION["User"]["us_id"];
    $last_id = "";
    $sql = "INSERT INTO tbl_stock_in 
                (
                    code,
                    total_paid,
                    create_by
                )
            VALUES (
                '".$code."', 
                '".$paid."',
                '".$user."'
            )";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        
        //Insert to detail table
        $sql_detail = "INSERT INTO tbl_stock_in_detail
                        (
                            stock_in_id,
                            product_id,
                            qty,
                            create_by
                        )
                        VALUES
                        ";
        $products = $_POST["txt_product"];
        $qtys = $_POST["txt_qty"];
        foreach( $products as $key => $product ) {
            if($key==0)
            continue;
            $sql_detail .= "('".$last_id."','".$product."','".$qtys[$key]."','".$user."'),";
        }
        $sql_detail = rtrim($sql_detail,",");
        if ($conn->query($sql_detail) === TRUE) {
            $mess = '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> 1 Row has been created with code : '.$code.'.
                    </div>';
        }
        else{
            die( "Error: " . $sql_detail . "" . $conn->error);
        }

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
            <!-- <h1 class="m-0 text-dark">Stock In</h1> -->
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
                        <?=@$mess?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Stock In</h3>
                        </div>
                        <form role="form" method='post' enctype="multipart/form-data"> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="pid">Code  <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" name="txt_import_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="pid">Total Paid  <i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" name="txt_total_paid">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="btn-block">&emsp;</label>
                                            <button type="submit" class="btn btn-primary btn_save" name="btn_save">Save</button >
                                            <a href="index.php" class="btn btn-danger">Back</a>
                                            <button type="button" class="btn btn-success" name="btn_add " onclick="add_row()"><i class="fa fa-plus"></i></button >
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label> Upload (.xlsx)</label>
                                            <input type="file" name="txt_excel_file" id="txt_excel">
                                            <button type="button" onclick="read_data()">Show</button>
                                        </div>
                                    </div> -->
                                </div>
                                    <table class="table table-bordered table-hover main_table table-striped ">
                                        <tr class="text-center">
                                            <th>Nº</th>
                                            <th>Product</th>
                                            <th>QTY</th>
                                            <th><i class="fas fa-cog fa-spin"></i>Action</th>
                                        </tr>
                                        <tr class="main_row" style="display:none;">
                                            <td class="lbl_serial text-center">
                                            
                                            </td>
                                            <td>
                                                <select class="form-control" name="txt_product[]" onchange="select_product(this)" id="txt_product">
                                                    <option value="">==Select Item==</option>
                                                    <?php
                                                        $sql_product = "select * from tbl_product";
                                                        $result = $conn->query($sql_product);
                                                        if($result->num_rows > 0){
                                                            while($product_row = $result->fetch_array()){
                                                                ?>
                                                        <option value="<?=@$product_row["pr_id"]?>"><?=@$product_row["pr_name"]?></option>
                                                    <?php
                                                            }
                                                        }
                                                        
                                                        ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="txt_excel" name="txt_qty[]">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" title="Remove" onclick="remove_row(this)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <div class="card-footer">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>
  <script>
    
    setTimeout(() => {
        add_row();
    }, 100);

    //Function for add more row of table by Vanda//20201113
    function add_row() {
        
        var main_row = $('.main_row').html();
        main_row = "<tr>"+main_row+"</tr>";
        $('.main_table').append(main_row);

        refresh_serial();
    }

    //Function for remove row of table by Vanda//20201113
    function remove_row(e) {
        if($('.lbl_serial').length > 2 ){
            $(e).parents('tr').remove();
            refresh_serial();
        }
    }

    //Function for refresh Nº row of table by Vanda//20201113
    function refresh_serial() {
        var count = 0;
        $('.lbl_serial').each(function() {
            $(this).html(count++);
        });
    }

    function check_duplicate_row(product_id){
        var i = 0;
        var b = 0;
        var result = "0";
        $('table #txt_product').each(function() {
            if(i==0){
                i++;
            }
            else{
                if($(this).val() == product_id){
                    b++;
                    if(b>1){
                        result = "1";
                    }
                }
            }
            i++;
        });
        return result;
    }

    function select_product(e){
        var product_id = $(e).val();
        var status = check_duplicate_row(product_id);
        
        if(status == "1"){
            $(e).parents('tr').css('background','red');
        }
        else{
            $(e).parents('tr').css('background','none');
        }
    }
  </script>
  <?php include'../layout/footer.php';?>
