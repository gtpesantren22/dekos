<?php
include '../function.php';

$tempat = $_POST['tempat'];
$tahun = $_POST['tahun'];
$nama = $_POST['nama'];
$no = 1;
?>

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th rowspan="2" style="width: 10px">#</th>
            <th rowspan="2">Tempat</th>
            <th rowspan="2">Bulan</th>
            <th rowspan="2">Jml Santri</th>
            <th rowspan="2">Tarif</th>
            <th rowspan="2">Total Tagihan</th>
            <th rowspan="2">Real Masuk</th>
            <th colspan="3">Setoran</th>
        </tr>
        <tr>
            <th>90%</th>
            <th>Sudah Setor</th>
            <th>Sisa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalTagihan = 0;
        $totalMasuk = 0;
        $totalSetor = 0;
        $totalSisa = 0;
        $totalPsr90 = 0;
        for ($i = 1; $i <= 12; $i++):
            $kunci = mysqli_fetch_object(mysqli_query($conn, "SELECT COUNT(*) as jml FROM kunci WHERE bulan = $i AND tahun = '$tahun' AND t_kos = $tempat AND ket = 0 "));
            $masuk = mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as jml FROM kos JOIN kunci ON kos.nis=kunci.nis WHERE kunci.bulan = $i AND kunci.tahun = '$tahun' AND kos.bulan = $i AND kos.tahun = '$tahun' AND kunci.t_kos = $tempat AND kunci.ket = 0 "));
            $jmlMasuk = $masuk->jml ? $masuk->jml : 0;
            $psr90 = ($kunci->jml * $tarif) != 0 ? ($kunci->jml * $tarif) * 90 / 100 : 0;
            $setor = mysqli_fetch_object(mysqli_query($conn, "SELECT SUM(nominal) as jml FROM setor WHERE bulan = $i AND tahun = '$tahun' AND t_kos = $tempat "));
            $jmlSetor = $setor->jml ? $setor->jml : 0;
            $sisa = $psr90 - $jmlSetor;

            $totalTagihan += ($kunci->jml * $tarif);
            $totalMasuk += $jmlMasuk;
            $totalSetor += $jmlSetor;
            $totalSisa += $sisa;
            $totalPsr90 += $psr90;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $nama ?></td>
                <td><?= bulan($i) ?></td>
                <td><?= $kunci->jml ?></td>
                <td><?= rupiah($tarif) ?></td>
                <td><?= rupiah($kunci->jml * $tarif) ?></td>
                <td><?= rupiah($jmlMasuk) ?></td>
                <td><?= rupiah($psr90) ?></td>
                <td><?= rupiah($jmlSetor) ?></td>
                <td><?= rupiah($sisa) ?></td>
            </tr>
        <?php endfor ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">TOTAL</th>
            <th><?= rupiah($totalTagihan) ?></th>
            <th><?= rupiah($totalMasuk) ?></th>
            <th><?= rupiah($totalPsr90) ?></th>
            <th><?= rupiah($totalSetor) ?></th>
            <th><?= rupiah($totalSisa) ?></th>
        </tr>
    </tfoot>
</table>