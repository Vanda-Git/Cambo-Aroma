<?php include'../config/database.php';?>
<?php
    $id = $_POST["id"];
    $per = $_POST["per"];
    $ischeck = $_POST["ischeck"];

    if($ischeck == "true"){
        $ischeck = 1;
    }
    else{
        $ischeck = 0;
    }
    $sql = "UPDATE tbl_product SET Isdiscount='$ischeck',disPercent='$per' WHERE pr_id = '".$id."'";
    if($conn->query($sql)){
        echo "1";
    }
    else{
        echo "0";
    }

?>