<?php
//include('dbconnected.php');
include('function.php');

$kode = $_GET["kode"];
// $id = $_GET["id"];
if (del_keluar($kode) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/pengeluaran/keluar';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/pengeluaran/keluar';
        </script>";
}

?>
<!-- OK -->