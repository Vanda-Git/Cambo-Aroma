<?php
if(@$_SESSION["User"] == ""){
    echo "<script>window.location.href='../Login.php'</script>";
}
?>