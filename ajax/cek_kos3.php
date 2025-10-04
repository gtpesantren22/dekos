<?php
include '../function.php';
$t_kos = $_POST['t_kos'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

$tk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tempat WHERE kd_tmp = '$t_kos' "));

if ($bulan == 1) {
    $bl = "Januari";
} elseif ($bulan == 2) {
    $bl = "Feburari";
} elseif ($bulan == 3) {
    $bl = "Maret";
} elseif ($bulan == 4) {
    $bl = "April";
} elseif ($bulan == 5) {
    $bl = "Mei";
} elseif ($bulan == 6) {
    $bl = "juni";
} elseif ($bulan == 7) {
    $bl = "Juli";
} elseif ($bulan == 8) {
    $bl = "Agustus";
} elseif ($bulan == 9) {
    $bl = "September";
} elseif ($bulan == 10) {
    $bl = "Oktober";
} elseif ($bulan == 11) {
    $bl = "November";
} elseif ($bulan == 12) {
    $bl = "Desember";
}
?>
<form action="" method="post">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    Data dari :
                    <br />
                    <br />
                    <p class="label label-primary"> TEMPAT : <?= $tk['nama']; ?> </p>
                    <p class="label label-warning"> BULAN : <?= $bl; ?></p>
                    <p class="label label-danger"> TAHUN : <?= $tahun; ?></p>
                </h3>
                <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                    </span>
                    Download excel</a>
            </div>
            <hr>
            <div class="box-body">
                <?php
                mysqli_query($conn, "DROP VIEW IF EXISTS rekap");
                mysqli_query($conn, "DROP VIEW IF EXISTS rekap2");

                mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, b.t_kos, b.nama, b.k_formal, b.nis, b.t_formal, b.alamat FROM kos AS a 
                            INNER JOIN kunci AS b ON a.nis = b.nis WHERE b.t_kos = $t_kos 
                            AND a.bulan = $bulan AND a.tahun = '$tahun' AND b.bulan = $bulan AND b.tahun = '$tahun' AND b.ket = 0 GROUP BY nis ");

                mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis, k_formal, t_formal, kamar, komplek, alamat FROM kunci WHERE t_kos = $t_kos  AND ket = 0 AND bulan = $bulan AND tahun = '$tahun' ");

                $lunas = mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 ORDER BY nama");
                $belum = mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 ORDER BY nama");
                $tidak = mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis ORDER BY nama) ");
                ?>
                <center>
                    <h3><span class="label label-success">Data sudah lunas</span></h3>
                </center>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1_bst">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Bayar</th>
                                <th>Kurang</th>
                                <th>Ket</th>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            <?php foreach ($lunas as $r) : ?>
                                <?php
                                if ($bulan == 1) {
                                    $bl = "Januari";
                                } elseif ($bulan == 2) {
                                    $bl = "Feburari";
                                } elseif ($bulan == 3) {
                                    $bl = "Maret";
                                } elseif ($bulan == 4) {
                                    $bl = "April";
                                } elseif ($bulan == 5) {
                                    $bl = "Mei";
                                } elseif ($bulan == 6) {
                                    $bl = "juni";
                                } elseif ($bulan == 7) {
                                    $bl = "Juli";
                                } elseif ($bulan == 8) {
                                    $bl = "Agustus";
                                } elseif ($bulan == 9) {
                                    $bl = "September";
                                } elseif ($bulan == 10) {
                                    $bl = "Oktober";
                                } elseif ($bulan == 11) {
                                    $bl = "November";
                                } elseif ($bulan == 12) {
                                    $bl = "Desember";
                                }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r['nama']; ?></td>
                                    <td><?= $r['alamat']; ?></td>
                                    <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                    <td><?= $bl; ?> <?= $tahun; ?></td>
                                    <td><?= rupiah($r['jml']); ?></td>
                                    <?php $j = 300000 - $r['jml']; ?>
                                    <td><?= rupiah($j); ?></td>
                                    <td style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <center>
                    <h3><span class="label label-warning">Data Belum Lunas</span></h3>
                </center>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example2_bst">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Bayar</th>
                                <th>Kurang</th>
                                <th>Ket</th>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            <?php foreach ($belum as $r) : ?>
                                <?php
                                if ($bulan == 1) {
                                    $bl = "Januari";
                                } elseif ($bulan == 2) {
                                    $bl = "Feburari";
                                } elseif ($bulan == 3) {
                                    $bl = "Maret";
                                } elseif ($bulan == 4) {
                                    $bl = "April";
                                } elseif ($bulan == 5) {
                                    $bl = "Mei";
                                } elseif ($bulan == 6) {
                                    $bl = "juni";
                                } elseif ($bulan == 7) {
                                    $bl = "Juli";
                                } elseif ($bulan == 8) {
                                    $bl = "Agustus";
                                } elseif ($bulan == 9) {
                                    $bl = "September";
                                } elseif ($bulan == 10) {
                                    $bl = "Oktober";
                                } elseif ($bulan == 11) {
                                    $bl = "November";
                                } elseif ($bulan == 12) {
                                    $bl = "Desember";
                                }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r['nama']; ?></td>
                                    <td><?= $r['alamat']; ?></td>
                                    <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                    <td><?= $bl; ?> <?= $tahun; ?></td>
                                    <td style="font-weight: bold; color: orange;"><?= rupiah($r['jml']); ?></td>
                                    <?php $j = 300000 - $r['jml']; ?>
                                    <td style="font-weight: bold; color: orange;"><?= rupiah($j); ?></td>
                                    <td style="font-weight: bold; color: orange;"><span class="fa fa-refresh"></span>
                                        Blm
                                        Lunas
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <center>
                    <h3><span class="label label-danger">Data Belum Bayar</span></h3>
                </center>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example3_bst">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Bayar</th>
                                <th>Kurang</th>
                                <th>Ket</th>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            <?php foreach ($tidak as $r) : ?>
                                <?php
                                if ($bulan == 1) {
                                    $bl = "Januari";
                                } elseif ($bulan == 2) {
                                    $bl = "Feburari";
                                } elseif ($bulan == 3) {
                                    $bl = "Maret";
                                } elseif ($bulan == 4) {
                                    $bl = "April";
                                } elseif ($bulan == 5) {
                                    $bl = "Mei";
                                } elseif ($bulan == 6) {
                                    $bl = "juni";
                                } elseif ($bulan == 7) {
                                    $bl = "Juli";
                                } elseif ($bulan == 8) {
                                    $bl = "Agustus";
                                } elseif ($bulan == 9) {
                                    $bl = "September";
                                } elseif ($bulan == 10) {
                                    $bl = "Oktober";
                                } elseif ($bulan == 11) {
                                    $bl = "November";
                                } elseif ($bulan == 12) {
                                    $bl = "Desember";
                                }
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r['nama']; ?></td>
                                    <td><?= $r['alamat']; ?></td>
                                    <td><?= $r['k_formal']; ?> <?= $r['t_formal'];; ?></td>
                                    <td><?= $bl; ?> <?= $tahun; ?></td>
                                    <td style="font-weight: bold; color: red;"> -</td>
                                    <td style="font-weight: bold; color: red;"> -</td>
                                    <td style="font-weight: bold; color: red;"><span class="fa fa-close"></span> Tak
                                        Bayar
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
            <div class="row">
                <div class="table-responsive">
                    <?php $total = mysqli_num_rows($lunas) + mysqli_num_rows($belum) + mysqli_num_rows($tidak); ?>
                    <div class="col-xs-6 pull-right">
                        <table class="table">
                            <tr>
                                <td><?= rupiah(mysqli_num_rows($lunas) * 300000); ?></td>
                            </tr>
                            <tr>
                                <td><?= rupiah(mysqli_num_rows($belum) * 300000); ?></td>
                            </tr>
                            <tr>
                                <td><?= rupiah(mysqli_num_rows($tidak) * 300000); ?></td>
                            </tr>
                            <tr>
                                <th><?= rupiah($total * 300000); ?>
                                </th>
                            </tr>
                        </table>
                    </div><!-- /.col -->
                    <div class="col-xs-6 pull-right">
                        <table class="table">
                            <tr>
                                <th>Lunas</th>
                                <td><?= mysqli_num_rows($lunas); ?></td>
                            </tr>
                            <tr>
                                <th>Belum Lunas</th>
                                <td><?= mysqli_num_rows($belum); ?></td>
                            </tr>
                            <tr>
                                <th>Tidak Bayar</th>
                                <td><?= mysqli_num_rows($tidak); ?></td>
                            </tr>
                            <tr>
                                <th style="width:50%">TOTAL</th>
                                <th><?= $total; ?>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
</form>