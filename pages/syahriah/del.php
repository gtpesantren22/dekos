<?php
//include('dbconnected.php');
include('function.php');

$id = $_GET["id"];
if (del_syahriah($id) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/syahriah/syah';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/syahriah/syah';
        </script>";
}

?>
<!-- OK -->