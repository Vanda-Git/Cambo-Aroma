<?php include'../config/database.php';?>
<?php
    $stock_in = @$_GET["id"];
    $sql_stock_in = "   SELECT 
                            DATE_FORMAT(A.create_date,'%Y-%m-%d %h:%i %p') AS date,A.*,B.us_fullname
                        FROM tbl_stock_out AS A 
                        left join tbl_user AS B on A.create_by = B.us_id
                        where A.id='".$stock_in."'
                    ";
    $result_stock_in = $conn->query($sql_stock_in);
    if($result_stock_in->num_rows > 0){
        while($row_stock_in=$result_stock_in->fetch_array()){
            $code = $row_stock_in["code"];
            $paid = $row_stock_in["total_paid"];
            $date = $row_stock_in["date"];
            $us_fullname = $row_stock_in["us_fullname"];
        }
    }

?>
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- custom style -->
<style>
    *,h2{
        font-family:Time new romance;
    }
</style>
    <h2 class="text-center">AROMA INVOICE</h2>
    <font> <b> Code :</b> <?=$code?></font> <br>
    <!-- <font> <b> Total paid :</b> $<?=$paid?></font><br> -->
    <font> <b> Date :</b> <?=$date?></font><br>
    <font> <b> Sale By :</b> <?=$us_fullname?></font><br>
    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <tr class="text-center">
            <th>Nº</th>
            <th>Product</th>
            <th>QTY</th>
            <th>Unit Price</th>
        </tr>

        <?php
            $sql_stockin_detail = "SELECT * FROM tbl_stock_out_detail AS A left join tbl_product AS B on A.product_id = B.pr_id where stock_out_id = '".$stock_in."'";
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
            <td>
                $<?=$row_stock_in_detail["unit_price"]?>
            </td>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <th colspan="3" class="text-right">Payment :</th>
            <th>$<?=$paid?></th>
        </tr>
    </table>
    <h4 class="text-center">Thank you!</h4><hr>
    <script>
        window.print();
        window.onfocus=function(){ window.close();}
    </script>
    
  <?php //include'../layout/footer.php';?>
