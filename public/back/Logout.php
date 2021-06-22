<?php include'config/database.php';?>
<?php
    session_destroy();
    echo "<script>window.location.href='Login.php'</script>";
?>