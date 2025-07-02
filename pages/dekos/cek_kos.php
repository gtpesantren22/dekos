
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Cek Data Dekosan (Perkelas)
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Jenjang</label>
                                <select name="t_formal" id="t_formal" class="form-control" required>
                                    <option value="">Pilih Lembaga</option>
                                    <?php
                                    $sq = mysqli_query($conn, "SELECT lembaga FROM kl_formal GROUP BY lembaga");
                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                    ?>
                                        <option value="<?= $kl['lembaga'] ?>"><?= $kl['lembaga'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="k_formal" id="k_formal" class="form-control" required>
                                    <option value="">- pilih kelas -</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>

                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cari" class="btn btn-block btn-success"><span class="fa fa-search">
                                        Cek</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $kelas = $_POST['k_formal'];
            $klsK = explode('-', $kelas);
            
            $kls = $klsK[0];
            $jur = $klsK[1];
            $rom = $klsK[2];
            $tingkat = $_POST['t_formal'];
            
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
        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                Data dari :
                                <br />
                                <br />
                                <p class="label label-primary"> KELAS : <?= $kelas; ?> <?= $tingkat; ?></p>
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

                            mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, b.nama, b.k_formal, b.nis, b.t_formal, b.r_formal, b.jurusan FROM kos AS a 
                            JOIN kunci AS b ON a.nis = b.nis WHERE b.k_formal = '$kls' AND b.t_formal = '$tingkat' AND b.r_formal = '$rom' AND b.jurursan = '$jur' 
                            AND a.bulan = $bulan AND a.tahun = '$tahun' AND b.bulan = $bulan AND b.tahun = '$tahun' AND ket = 0 GROUP BY nis ORDER BY nominal ASC");

                            mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis FROM kunci WHERE k_formal = '$kls' AND t_formal = '$tingkat' AND r_formal = '$rom' AND jurursan = '$jur' AND ket = 0  AND bulan = $bulan AND tahun = '$tahun' ");

                            $lunas = mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 ");
                            $belum = mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 ");
                            $tidak = mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis) ");
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
                                            <th>Kelas</th>
                                            <th>Bulan</th>
                                            <th>Jumlah Bayar</th>
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
                                            <th>Kelas</th>
                                            <th>Bulan</th>
                                            <th>Jumlah Bayar</th>
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
                                            <th>Kelas</th>
                                            <th>Bulan</th>
                                            <th>Jumlah Bayar</th>
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
                                                <td><?= $kelas; ?> <?= $tingkat; ?></td>
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
                            <?php $total = mysqli_num_rows($lunas) + mysqli_num_rows($belum) + mysqli_num_rows($tidak); ?>
                            <div class="col-xs-6 pull-right">
                                <div class="table-responsive">
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
                                </div>
                            </div><!-- /.col -->
                            <div class="col-xs-6 pull-right">
                                <div class="table-responsive">
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
                            </div>
                        </div><!-- /.row -->
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</section>