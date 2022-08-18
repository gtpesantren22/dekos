<?php
require '../function.php';
$b = $_GET['bl'];
$th = $_GET['thn'];
$masuk =  query("SELECT a.tgl, a.nama, no_nota, masuk, keluar, ket, nama_i, kode_i FROM kas a JOIN item b ON a.item=b.id_item JOIN keluar c ON a.kode=c.kode WHERE MONTH(a.tgl) = $b AND YEAR(a.tgl) = $th ORDER BY keluar,kode_i,tgl ASC");
$item =  query("SELECT SUM(masuk) as masuk, SUM(keluar) as keluar, nama_i, kode_i FROM kas a JOIN item b ON a.item=b.id_item WHERE MONTH(tgl) = $b AND YEAR(tgl) = $th GROUP BY kode_i ORDER BY ket DESC");
$M =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT tgl, SUM(masuk) as jm, SUM(keluar) as jk FROM kas WHERE MONTH(tgl) = $b AND YEAR(tgl) = $th "));
$bl = array("", "Januari", "Januari", "Februari", "Maret", "April", "Mei", "Juny", "July", "September", "Oktober", "November", "Desember");
?>
<!-- <h4><?= $th ?></h4> -->
<!-- <button class="btn btn-danger pull-right"><i class="fa fa-print"></i> Print Laporan</button> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <strong>
        <center> Data Kas Pesantren</center><br>
        <center> Bulan <?= $bl[$b] . ' ' . $th ?></center>
    </strong>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Kode</th>
                <th>No. Nota</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;

            foreach ($masuk as $r) :
            ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $r["nama_i"]; ?> </td>
                    <td><?= $r["kode_i"]; ?> </td>
                    <td><?= $r["no_nota"]; ?> </td>
                    <td><?= date("d-M-Y", strtotime($r["tgl"])); ?> </td>
                    <td><?= $r["nama"]; ?></td>

                    <?php if ($i == 1) {
                        $debit = $r['masuk'];
                        $saldo =  $r['masuk']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } elseif ($r['masuk'] != 0) {
                        $saldo = $saldo + $r['masuk']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } else {
                        $saldo = $saldo - $r['keluar']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } ?>
                <?php $i++;
            endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">
                    Total :
                </th>
                <th style="background-color: #00A65A; color: white"><?= rupiah($M['jm']); ?></th>
                <th style="background-color: #DD4B39; color: white"><?= rupiah($M['jk']); ?></th>
                <th style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
            </tr>
        </tfoot>
    </table>

    <hr>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Kode</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;

            foreach ($item as $r) :
            ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $r["nama_i"]; ?> </td>
                    <td><?= $r["kode_i"]; ?> </td>
                    <?php if ($i == 1) {
                        $debit = $r['masuk'];
                        $saldo =  $r['masuk']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } elseif ($r['masuk'] != 0) {
                        $saldo = $saldo + $r['masuk']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } else {
                        $saldo = $saldo - $r['keluar']; ?>
                        <td><?= rupiah($r['masuk']) ?></td>
                        <td><?= rupiah($r['keluar']) ?></td>
                        <td><?= rupiah($saldo) ?></td>
                    <?php } ?>
                <?php $i++;
            endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <th colspan="3" class="text-right">
                    Total :
                </th>
                <th style="background-color: #00A65A; color: white"><?= rupiah($M['jm']); ?></th>
                <th style="background-color: #DD4B39; color: white"><?= rupiah($M['jk']); ?></th>
                <th style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
            </tr>
        </tfoot>
    </table>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Rekapan Buku Kas.xls");
    ?>
</body>

</html>