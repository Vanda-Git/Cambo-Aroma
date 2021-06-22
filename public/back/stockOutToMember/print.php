<?php include'../config/database.php';?>
<?php
    $stock_in = @$_GET["id"];
    $sql_stock_in = "   SELECT 
                            DATE_FORMAT(A.create_date,'%Y-%m-%d %h:%i %p') AS date,A.*,B.us_fullname
                        FROM tbl_stock_out_to_member AS A 
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
    tr.mytablehead{
        background-color:silver !important;
    }
</style>
    <img src="../images/system/AROMA_LOGO.png" alt="AROMA_LOGO" style="width:200px;position:absolute;left:10px;top:5px;">
    <h2 class="text-center">អារ៉ូម៉ា ខូស្មិទិក (ខេមបូឌា) ឯ.ក</h2>
    <h3 class="text-center" style="color:red;font-weight:bold;">Aroma Cosmetic (Cambodia) Co., LTD</h3>
    <h5 class="text-center">#55 E1, St.110, Tuek Thla, Sk. Tuek Thla, Kh. Sen Sok, Phnom Penh, Camdodia</h4>
    <font> <b> Code :</b> <?=$code?></font> <font style="float:right;"> <b> សម្រាប់ព័ត៌មានលម្អិតៈលោក​ ប៉ាត សាម៉ឺឌី</b></font><br>
    <!-- <font> <b> Total paid :</b> $<?=$paid?></font><br> -->
    <font> <b> Date :</b> <?=$date?></font> <font style="float:right;"> <b> ទូរស័ព្ទលេខៈ 099 347 773 / 016 387 773</b></font> <br>
    <font> <b> Sale By :</b> <?=$us_fullname?></font> <font style="float:right;"> <b> តំបន់ចែកចាយៈ090 ​/ 069 / 099 427 773</b></font><br>
    <table class="table table-bordered table-striped dataTable dtr-inline mytable">
        <tr class="text-center mytablehead">
            <th>Nº</th>
            <th>Product</th>
            <th>QTY</th>
            <th>Commision Percentage (%)</th>
            <th>Unit Price</th>
            <th>Unit Price(Full Price)</th>
            <th>Total</th>
        </tr>

        <?php
            $sql_stockin_detail = "SELECT *
                                        ,((A.unit_price)*(A.percentage/100) ) AS commision_price
                                        ,((A.qty*A.unit_price)*(A.percentage/100) ) AS commision_total_price
                                    FROM tbl_stock_out_to_member_detail AS A
                                    left join tbl_product AS B on A.product_id = B.pr_id
                                    where stock_out_id = '".$stock_in."'";
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
                <?=$row_stock_in_detail["percentage"]?>%
            </td>
            <td>
                $<?=number_format($row_stock_in_detail["commision_price"],2)?>
            </td>
            <td>
                $<?=number_format($row_stock_in_detail["unit_price"],2)?>
            </td>
            <td>
                $<?=number_format($row_stock_in_detail["commision_total_price"],2)?>
            </td>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <th colspan="6" class="text-right">Payment :</th>
            <th>$<?=$paid?></th>
        </tr>
    </table>
    <h4 class="text-center">Thank you!</h4><hr>
    <script>
        window.print();
        window.onfocus=function(){ window.close();}
    </script>
    
  <?php //include'../layout/footer.php';?>
