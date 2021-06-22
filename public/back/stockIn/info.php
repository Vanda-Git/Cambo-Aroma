<?php include'../config/database.php';?>
<?php //include'../layout/header.php';?>
<?php
    $stock_in = @$_GET["id"];
    $sql_stock_in = "   SELECT 
                            * 
                        FROM tbl_stock_in AS A 
                        where A.id='".$stock_in."'
                    ";
    $result_stock_in = $conn->query($sql_stock_in);
    if($result_stock_in->num_rows > 0){
        while($row_stock_in=$result_stock_in->fetch_array()){
            $code = $row_stock_in["code"];
            $paid = $row_stock_in["total_paid"];
            $date = $row_stock_in["create_date"];
        }
    }

?>
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <font> <b> Code :</b> <?=$code?></font> <br>
    <font> <b> Total paid :</b> $<?=$paid?></font><br>
    <font> <b> Date :</b> <?=$date?></font><br>
    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <tr class="text-center">
            <th>Nº</th>
            <th>Product</th>
            <th>QTY</th>
        </tr>

        <?php
            $sql_stockin_detail = "SELECT * FROM tbl_stock_in_detail AS A left join tbl_product AS B on A.product_id = B.pr_id where stock_in_id = '".$stock_in."'";
            $result_stock_in_detail = $conn->query($sql_stockin_detail);
            $count = 0;
            if($result_stock_in_detail->num_rows > 0){
                while($row_stock_in_detail = $result_stock_in_detail->fetch_array()){
        ?>

        <tr>
            <td class="lbl_serial text-center">
                <?=++$count?>
            </td>
            <td>
                    <?php echo $row_stock_in_detail["pr_name"];
                    ?>
            </td>
            <td>
                <?=$row_stock_in_detail["qty"]?>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
  <?php //include'../layout/footer.php';?>
