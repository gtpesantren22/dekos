<?php
//include('dbconnected.php');
include('../../function.php');

//$id = $_GET["id"];
$bulan = $_GET["bulan"];
$tahun = $_GET["tahun"];
$pa = (int)$_GET["pa"];
$pi = (int)$_GET["pi"];

$nama = 'Setor ke Nyai Zahro';
$nominal = $pa + $pi;
$tgl = date("m/d/Y");

$query = mysqli_query($conn, "INSERT INTO setor VALUES('', 'Setor ke Nyai Zahro', 'Setoran ke-', 'Setoran ke-', $bulan, '$tahun', $pa, $pi, $nominal, '$tgl', '') ");

if ($query) {
    echo "
        <script>
            document.location.href = '../../index.php?link=pages/setor/setor';
        </script>    
";
} else {
    echo "<script>
            alert('Data Gagal disimpan');
        </script>";
}

?>
<!-- OK -->