<?php
require '../../function.php';
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

$data =  query("SELECT * FROM masuk WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER by id ASC ");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM masuk WHERE tgl BETWEEN '$dari' AND '$sampai' "));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data</title>

    <!-- <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body>
    <h2 style="text-align: center;">Data Pemasukan</h2>
    <h3 style="text-align: center;">PP Darul Lughah Wal Karomah</h3>
    <td>Data Tanggal</td>
    <td> : </td>
    <td><?= date("d F Y", strtotime($dari)); ?> s/d <?= date("d F Y", strtotime($sampai));; ?></td>
    <hr>
    <table width="100%" cellspacing="0" border="1" cellpadding="5">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Nominal</th>
            <th>Tanggal Terima</th>
            <th>Penerima</th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            ?>
            <?php foreach ($data as $r) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $r["nama"]; ?> </td>
                <td><?= rupiah($r["nominal"]); ?></td>
                <td><?= $r["tgl"]; ?> </td>
                <td><?= $r["penerima"]; ?> </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    &nbsp;
    <table>
        <tr style="font-size: 15px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: green;">
            <td>Data Tanggal</td>
            <td> : </td>
            <td><?= date("d F Y", strtotime($dari)); ?> s/d <?= date("d F Y", strtotime($sampai));; ?></td>
        </tr>
        <tr style="font-size: 15px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: blue;">
            <td>Jumlah Pemasukan</td>
            <td> : </td>
            <td><?= rupiah($total['total']); ?></td>
        </tr>
    </table>
</body>
<script>
window.print();
</script>

</html>