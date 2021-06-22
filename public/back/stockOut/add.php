<?php include'../config/database.php';?>
<?php include'../layout/header.php';?>
<?php 
  if(isset($_POST["btn_save"])){
      $paid = @$_POST["txt_total_paid"];
      $user = @$_SESSION["User"]["us_id"];
      $last_id = "";
      $code = "INV-".date("Ymdhis");
    
    $sql = "INSERT INTO tbl_stock_out
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
    // die($sql);
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        
        //Insert to detail table
        $sql_detail = "INSERT INTO tbl_stock_out_detail
                        (
                            stock_out_id,
                            product_id,
                            qty,
                            unit_price,
                            create_by
                        )
                        VALUES
                        ";
        $products = $_POST["txt_product"];
        $qtys = $_POST["txt_qty"];
        $unit_price = $_POST["txt_unit_price"];
        foreach( $products as $key => $product ) {
            if($key==0)
            continue;
            $sql_detail .= "('".$last_id."','".$product."','".$qtys[$key]."','".$unit_price[$key]."','".$user."'),";
        }
        $sql_detail = rtrim($sql_detail,",");
        if ($conn->query($sql_detail) === TRUE) {
            $mess = '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> 1 Row has been created with code : '.$code.'.
                        <a href="print.php?id='.$last_id.'" target="_blank">Print <i class="fa fa-print"></i></a>
                    </div>';
            // header('Location: print.php?id='.$last_id);
            // exit;
            // echo "<script>window.location.href='print.php?id='".$last_id.";</script>";
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
                            <h3 class="card-title"> <a  href="index.php" class="fa fa-arrow-left"></a> New Stock In</h3>
                        </div>
                        <form role="form" method='post' enctype="multipart/form-data"> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="btn-block">&emsp;</label>
                                            <button type="button" class="btn btn-success" name="btn_add" onclick="add_row()"><i class="fa fa-plus"> Add Item</i></button >
                                        </div>
                                    </div>
                                </div>
                                    <table class="table table-bordered table-hover main_table table-striped ">
                                        <tr class="text-center">
                                            <th>Nº</th>
                                            <th>Product</th>
                                            <th>QTY</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
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
                                                <input type="number" class="form-control txt_qty" value="1" onchange="add_qty(this)" name="txt_qty[]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control txt_unit_price" placeholder="$10.00" readonly="" name="txt_unit_price[]" value="">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control txt_subtotal" id="txt_subtotal" name="txt_subtotal[]" readonly="">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger" title="Remove" onclick="remove_row(this)"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="btn-block">&emsp;</label>
                                            <button type="submit" class="btn btn-primary btn_save" name="btn_save">Save & Print</button >
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-3"> 
                                        <div class="form-group">
                                            <label for="pid">Total Paid  $<i class="text-danger">*</i></label>
                                            <input type="text" class="form-control" id="txt_total_paid" name="txt_total_paid" readonly="">
                                        </div>
                                    </div>
                                </div>
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
        $.post("ajx_get_sigle_product_info.php",
        {
            id: product_id
        },
        function(data, status){
            var obj = JSON.parse(data);
            $(e).parents('tr').find(".txt_unit_price").val(obj[0].pr_price);
            gen_subtotal(e);
            grand_total();
        });

        var status = check_duplicate_row(product_id);
        
        if(status == "1"){
            $(e).parents('tr').css('background','red');
        }
        else{
            $(e).parents('tr').css('background','none');
        }
    }
    function grand_total(){
        let i = 1;
        let payment = 0.0;
        $('table #txt_subtotal').each(function() {
            if(i == 1){
                i++;
            }   
            else{
                payment += parseFloat($(this).val());
            }
            $('#txt_total_paid').val(payment);
            i++;
        });
    }
    function gen_subtotal(e){
        var unit_price = $(e).parents('tr').find(".txt_unit_price").val();
        var qty = $(e).parents('tr').find(".txt_qty").val();
        $(e).parents('tr').find('.txt_subtotal').val(parseInt(qty)*parseFloat(unit_price));
    }
    function add_qty(e){
        gen_subtotal(e);
        grand_total();
    }
  </script>
  <?php include'../layout/footer.php';?>
