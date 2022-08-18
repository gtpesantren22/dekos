<?php
//include('dbconnected.php');
include('function.php');

$id = $_GET["id"];
if (del_akun($id) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/akun/akun';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/akun/akun';
        </script>";
}

?>
<!-- OK -->