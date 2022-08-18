<?php
//include('dbconnected.php');
include('function.php');

//$id = $_GET["id"];
$kode = $_GET["kode"];
if (del_masuk($kode) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/pemasukan/masuk';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/pemasukan/masuk';
        </script>";
}

?>
<!-- OK -->