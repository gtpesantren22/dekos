<?php
include '../function.php';
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$tempat = $_POST['tkos'];

$hasil = mysqli_query($conn, "SELECT * FROM setor WHERE bulan = $bulan AND tahun = '$tahun' AND t_kos = $tempat ");
$jmlSantri = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM kunci WHERE t_kos = $tempat AND tahun = '$tahun' AND ket = 0 AND bulan = $bulan "));
$setor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) as total FROM setor WHERE bulan = $bulan AND tahun = '$tahun' AND t_kos = $tempat "));
$jmlSetor = $setor['total'] != null ? $setor['total'] : 0;
$masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) as total FROM kos JOIN kunci ON kos.nis=kunci.nis WHERE kos.bulan = $bulan AND kunci.bulan = $bulan AND kunci.tahun = '$tahun' AND kos.tahun = '$tahun' AND kunci.t_kos = $tempat "));
$psr90 = (90 / 100) * ($jmlSantri['jml'] * $tarif);
$psr30 = (30 / 100) * ($jmlSantri['jml'] * $tarif);
?>
<div class="row">
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <td>Jumlah Santri</td>
                    <td>
                        <!-- <span class="badge bg-red">55%</span> -->
                        <?= $jmlSantri['jml'] ?> santri
                    </td>
                </tr>
                <tr>
                    <td>Tarif per Santri</td>
                    <td>
                        <?= rupiah($tarif) ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Tagihan</td>
                    <td>
                        <b class="text-info"><?= rupiah($jmlSantri['jml'] * $tarif) ?></b>
                        <br>- <b class="text-danger">90% (<?= rupiah($psr90) ?>)</b>
                        <br>- <b class="text-danger">30% (<?= rupiah($psr30) ?>)</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <td>Real Masuk</td>
                    <td>
                        <b class="text-success"><?= $masuk['total'] ? rupiah($masuk['total']) : rupiah(0) ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Sudah Setor</td>
                    <td>
                        <b class="text-primary"><?= rupiah($jmlSetor) ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Sisa</td>
                    <td>
                        <b class="text-warning"><?= rupiah($psr90 - $jmlSetor) ?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($hasil as $r) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= date("d/m/Y", strtotime($r["tgl"])); ?> </td>
                    <td><?= $r['dari'] ?> </td>
                    <td><?= rupiah($r["nominal"]); ?></td>
                    <td><?= $r['via'] ?> </td>
                    <td><button class="btn btn-xs btn-danger" onclick="delItem(<?= $r['id'] ?>)"><i class="fa fa-trash"></i></button></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>