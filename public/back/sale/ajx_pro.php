<?php include'../config/database.php';?>
<?php
    $id = $_GET['id'];
    $sql= "select * from tbl_product where pr_id='".$id."'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      while($row=$result->fetch_array()){
      echo '<tr><td><p class=lbl_no>1</p></td><td>'.$row['pr_name'].'<input type="text" name="id[]" value="'.$id.'" hidden></td><td><input type=number name="qty[]"value=1 class="form-control" onchange="calculate_qty(this)"></td>
            <td>$<font class="lbl_price">'.$row['pr_price'].'</font><input type="text" name="price[]" value="'.$row['pr_price'].'" hidden></td><td >$<font class="lbl_amount">'.$row['pr_price'].'</font></td>
            <td><button class="btn btn-danger btn-xs" onclick="remove_row(this)">Remove</button><p style="display:none;" id="lbl_tmp_option"></p></td></tr>';
      }
    }

?>