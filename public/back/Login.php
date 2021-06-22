<?php include'config/database.php';?>
<?php
    if(isset($_POST["btn_login"])){
        $user = $_POST["txt_user"];
        $pass = md5($_POST["txt_password"]);
        $sql = "select * from tbl_user where us_username = '".$user."' and us_pass = '".$pass."' limit 1";
        $message = "";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
                $_SESSION["User"] = $row;
                echo "<script>window.location.href='dashboard/';</script>";
            }
        }
        else{
            $message = "<font color='red'>Incorrect information!!!</font><br>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aroma Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Welcome to Aroma Admin</h2>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form method="post">
                    User name
                    <input type="text" name="txt_user" class="form-control"> <br>
                    Password
                    <input type="password" name="txt_password" class="form-control"><br>
                    <?=@$message?>
                    <button type="submit" name="btn_login" class="btn btn-success">lOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>