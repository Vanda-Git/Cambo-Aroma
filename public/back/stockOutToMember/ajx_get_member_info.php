<?php
    include_once '../config/database.php';

    $id = $_POST["id"];
    $sql = "SELECT * FROM tbl_member_type where id = '".$id."'";
    $sth = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    print json_encode($rows);
?>