<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "aroma";
$servername = "sql310.epizy.com";
$username = "epiz_26878973";
$password = "WGW4a8FiWDXE";
$database = "epiz_26878973_aroma";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

if (!isset($_SESSION)) 
{
    session_start();
    ob_start();
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function count_new_order($conn){
    $sql = "select count(id) as t_count from orders where status = '1'";
    $mess = "";
    if($row = ($conn->query($sql))->fetch_array()){
        if($row["t_count"] > 0){   
            $mess = "<i class='fa fa-bullhorn'></i> Your new order <font size='5' color='red'>".$row["t_count"]."</font>";
        }
    }
    return $mess;
}
?>