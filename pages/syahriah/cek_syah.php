<?php
require 'function.php';
?>
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Cek Data Pembayaran Syahriah (Perkelas)
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="kelas" id="" class="form-control" required>
                                    <option value=""> --pilih kelas-- </option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Jenjang</label>
                                <select name="tingkat" id="" class="form-control" required>
                                    <option value=""> --pilih jenjang-- </option>
                                    <option value="MTs">MTs</option>
                                    <option value="SMP">SMP</option>
                                    <option value="MA">MA</option>
                                    <option value="SMK">SMK</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Tahap</label>
                                <select name="tahap" id="" class="form-control" required>
                                    <option value=""> --pilih tahapan-- </option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT nama FROM tahapan GROUP BY nama ");
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
                                <button type="submit" name="cari" class="btn btn-block btn-success"><span
                                        class="fa fa-search">
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
            $kelas = $_POST['kelas'];
            $tingkat = $_POST['tingkat'];
            $tahap = $_POST['tahap'];
            $tahun = $_POST['tahun'];

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
                            <p class="label label-warning"> Tahapan : <?= $tahap; ?></p>
                            <p class="label label-danger"> TAHUN : <?= $tahun; ?></p>
                        </h3>
                        <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                            target="_blank" type="button" class="btn btn-success pull-right"><span
                                class="fa fa-download">
                            </span>
                            Download excel</a>
                    </div>
                    <hr>
                    <div class="box-body">
                        <?php
                            mysqli_query($conn, "DROP VIEW syah1");
                            mysqli_query($conn, "DROP VIEW tahap");
                            mysqli_query($conn, "DROP VIEW santri1");

                            mysqli_query($conn, "CREATE VIEW syah1 AS SELECT a.nis, SUM(a.nominal) AS bayar, b.nama, b.k_formal, b.t_formal, b.stts FROM syahriah AS a INNER JOIN tb_santri AS b ON a.nis=b.nis WHERE b.k_formal = '$kelas' AND b.t_formal = '$tingkat' AND b.jkl = '$jkl' AND a.tahun = '$tahun' GROUP BY nis");
                            mysqli_query($conn, "CREATE VIEW tahap AS SELECT * FROM tahapan WHERE nama = '$tahap' ");
                            mysqli_query($conn, "CREATE VIEW santri1 AS SELECT a.nis, a.nama, a.k_formal, a.t_formal, b.nominal FROM tb_santri AS a INNER JOIN tahapan AS b ON a.stts=b.stts WHERE k_formal = '$kelas' AND t_formal = '$tingkat' AND jkl = '$jkl' AND b.nama = '$tahap' ");

                            $lunas = mysqli_query($conn, "SELECT a.nis, a.bayar, a.stts, a.nama, a.k_formal, a.t_formal, b.nominal, b.stts FROM syah1 AS a INNER JOIN tahap AS b ON a.stts=b.stts WHERE a.bayar >= b.nominal ORDER BY a.nama ASC");
                            $belum = mysqli_query($conn, "SELECT a.nis, a.bayar, a.stts, a.nama, a.k_formal, a.t_formal, b.nominal, b.stts FROM syah1 AS a INNER JOIN tahap AS b ON a.stts=b.stts WHERE a.bayar < b.nominal ORDER BY a.nama ASC ");
                            $tidak = mysqli_query($conn, "SELECT * FROM santri1 WHERE NOT EXISTS (SELECT * FROM syah1 WHERE santri1.nis = syah1.nis) ");
                            ?>
                        <div class="responsive-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tahap</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Jml <?= $tahap ?></th>
                                        <th>Ket</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        ?>
                                    <?php foreach ($lunas as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r['nama']; ?></td>
                                        <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                        <td><?= $tahap; ?></td>
                                        <td><?= rupiah($r['bayar']); ?></td>
                                        <td><?= rupiah($r['nominal']); ?></td>
                                        <td style="font-weight: bold; color: green;"><span class="fa fa-check"></span>
                                            Lunas
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="responsive-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tahap</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Jml <?= $tahap ?></th>
                                        <th>Ket</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        ?>
                                    <?php foreach ($belum as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r['nama']; ?></td>
                                        <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                        <td><?= $tahap; ?></td>
                                        <td style="font-weight: bold; color: orange;"><?= rupiah($r['bayar']); ?></td>
                                        <td style="font-weight: bold; color: orange;"><?= rupiah($r['nominal']); ?></td>
                                        <td style="font-weight: bold; color: orange;"><span
                                                class="fa fa-refresh"></span>
                                            Blm
                                            Lunas
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="responsive-table">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Tahap</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Jml <?= $tahap ?></th>
                                        <th>Ket</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        ?>
                                    <?php foreach ($tidak as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r['nama']; ?></td>
                                        <td><?= $kelas; ?> <?= $tingkat; ?></td>
                                        <td><?= $tahap; ?></td>
                                        <td style="font-weight: bold; color: red;"> -</td>
                                        <td style="font-weight: bold; color: red;"> <?= rupiah($r['nominal']) ?></td>
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
                            <div class="col-xs-3 pull-right">
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
        <?php
        }
        ?>
    </div>
</section>