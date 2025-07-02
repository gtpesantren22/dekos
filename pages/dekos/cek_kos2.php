
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Cek Data Dekosan (Sluruh Santri)
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        <!-- Date range -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Jenkel</label>
                                <select name="jkl" id="" class="form-control" required>
                                    <option value=""> --pilih jenkel-- </option>
                                    <option value="Laki-laki">Putra</option>
                                    <option value="Perempuan">Putri</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="stts" id="" class="form-control" required>
                                    <option value=""> --pilih -- </option>
                                    <option value="1">Lunas</option>
                                    <option value="2">Belum Lunas</option>
                                    <option value="3">Tidak Bayar</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="form-control" required>
                                    <option value=""> --pilih bulan-- </option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control" required>
                                    <option value=""> --pilih tahun-- </option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT * FROM tahun ");
                                    $no = 0;
                                    while ($thn = mysqli_fetch_array($th)) {
                                        $no++;
                                    ?>
                                    <option value="<?= $thn['nama'] ?>"><?= $thn['nama'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cari" class="btn btn-success"><span class="fa fa-search">
                                        Cek</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $jkl = $_POST['jkl'];
            $stts = $_POST['stts'];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];

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

            mysqli_query($conn, "DROP VIEW IF EXISTS rekap");
            mysqli_query($conn, "DROP VIEW IF EXISTS rekap2");

            mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, b.nama, b.nis, b.k_formal, b.t_formal, b.kamar FROM kos AS a 
                            INNER JOIN kunci AS b ON a.nis = b.nis WHERE a.bulan = $bulan AND a.tahun = '$tahun' AND b.bulan = $bulan AND b.tahun = '$tahun' AND ket = 0 AND jkl = '$jkl' GROUP BY nis ORDER BY nominal ASC");

            mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis, k_formal, t_formal, kamar FROM kunci WHERE ket = 0 AND jkl = '$jkl' AND bulan = $bulan AND tahun = '$tahun' ");
            $san = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kunci"));

            if ($stts == 1) {
                $data = mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 ");
            } elseif ($stts == 2) {
                $data = mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 ");
            } elseif ($stts == 3) {
                $data = mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis) ");
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
                            <?php if ($stts == 1) {
                                    $st = "LUNAS";
                                } elseif ($stts == 2) {
                                    $st = "BELUM LUNAS";
                                } elseif ($stts == 3) {
                                    $st = "TAK BAYAR";
                                } ?>
                            <p class="label label-primary"> STATUS : <?= $st; ?> </p>
                            <p class="label label-warning"> BULAN : <?= $bl; ?></p>
                            <p class="label label-danger"> TAHUN : <?= $tahun; ?></p>
                        </h3>
                        <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                            target="_blank" type="button" class="btn btn-success pull-right"><span
                                class="fa fa-download">
                            </span>
                            Download excel</a>
                    </div>
                    <div class="box-header">
                        <div class="col-xs-5">
                            <table class="table">
                                <tr>
                                    <th>Jumlah</th>
                                    <th><?= mysqli_num_rows($data); ?> santri</th>
                                </tr>
                                <tr>
                                    <th>Persentase</th>
                                    <?php
                                        $persen = (mysqli_num_rows($data) / $san) * 100;
                                        ?>
                                    <th><?= round($persen, 2); ?> %</th>
                                </tr>
                                <tr>
                                    <th style="width:50%">TOTAL</th>
                                    <th><?= rupiah(mysqli_num_rows($data) * 300000); ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example1_bst">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Kamar</th>
                                        <th>Bulan</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Kurang</th>
                                        <th>Ket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        ?>
                                    <?php foreach ($data as $r) : ?>
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
                                        <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                        <td><?= $r['kamar']; ?></td>
                                        <td><?= $bl; ?> <?= $tahun; ?></td>

                                        <?php if ($stts == 1) : ?>
                                        <td><?= rupiah($r['jml']); ?></td>
                                        <?php $j = 300000 - $r['jml']; ?>
                                        <td><?= rupiah($j); ?></td>
                                        <td style="font-weight: bold; color: green;"><span class="fa fa-check"></span>
                                            Lunas
                                        </td>
                                        <?php endif ?>

                                        <?php if ($stts == 2) : ?>
                                        <td style="font-weight: bold; color: orange;"><?= rupiah($r['jml']); ?></td>
                                        <?php $j = 300000 - $r['jml']; ?>
                                        <td style="font-weight: bold; color: orange;"><?= rupiah($j); ?></td>
                                        <td style="font-weight: bold; color: orange;"><span class="fa fa-refresh"> Blm
                                                Lunas</span>
                                        </td>
                                        <?php endif ?>

                                        <?php if ($stts == 3) : ?>
                                        <td style="font-weight: bold; color: red;"> -</td>
                                        <td style="font-weight: bold; color: red;"> -</td>
                                        <td style="font-weight: bold; color: red;"><span class="fa fa-close"></span> Tak
                                            Bayar
                                        </td>
                                        <?php endif ?>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">TOTAL</th>
                                        <th>TOTAL</th>
                                        <th>TOTAL</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div>
        </form>
        <?php
        }
        ?>
    </div>
</section>