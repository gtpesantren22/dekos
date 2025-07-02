
<section class="content-header">
    <h1>
        Cek History Pembayaran Santri
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
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <form action="" class="form-horizontal" method="post">
                        <!-- Date range -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Masukan NIS : </label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                    <input type="text" name="nis" class="form-control pull-right" autocomplete="off" placeholder="Masukan NIS / Scan KTS " autofocus required>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tahun");
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
                            <div class="col-sm-2">
                                <button type="submit" name="cari" class="btn btn-success"><span class="fa fa-search"></span>
                                    Tampilkan</button>
                            </div>
                        </div><!-- /.form group -->
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $nis = $_POST['nis'];
            $tahun = $_POST['tahun'];
            $syh = query("SELECT * FROM syahriah WHERE nis = '$nis' AND tahun = '$tahun' ");
            $bayar_santri = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM syahriah WHERE nis = '$nis' AND tahun = '$tahun' "));
            $sntr = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
            $st1 = $sntr["stts"];
            $byr = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM tahapan WHERE stts = '$st1' "));

        ?>
            <form action="" method="post">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                NIS Santri : <b><u><?= $nis; ?></u></b>
                            </h3>
                        </div>
                        <hr>
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>:</th>
                                    <th><?= $sntr['nama'] ?></th>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>:</th>

                                    <th><?= $sntr['desa'] ?> - <?= $sntr['kec'] ?> - <?= $sntr['kab'] ?></th>
                                </tr>
                                <tr>
                                    <th>K. Formal</th>
                                    <th>:</th>

                                    <th><?= $sntr['k_formal'] ?> <?= $sntr['t_formal'] ?></th>
                                </tr>
                                <tr>
                                    <th>K. Madin</th>
                                    <th>:</th>

                                    <th><?= $sntr['k_madin'] ?> <?= $sntr['r_madin'] ?></th>
                                </tr>
                                <tr>
                                    <th>Tempat</th>
                                    <th>:</th>

                                    <th><?= $sntr['kamar'] ?> / <?= $sntr['komplek'] ?></th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>:</th>
                                    <th><?php $stt = $sntr["stts"];
                                        $ps = explode("-", $stt);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>Peng. Wilyah</span>";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                </tr>
                                <tr>
                                    <th>Tahun </th>
                                    <th>:</th>

                                    <th><?= $tahun; ?></th>
                                </tr>
                                <tr>
                                    <th style="font-weight: bold; color: blue;">Pembayaran</th>
                                    <th style="font-weight: bold; color: blue;">:</th>
                                    <th style="font-weight: bold; color: blue;"><?= rupiah($byr['jml']); ?> - (1 Tahun)</th>
                                </tr>
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a href="index.php?link=pages/syah" class="btn btn-block btn-success"><span class="fa fa-shopping-cart"></span>
                                Bayar</a>
                        </div><!-- /.box-footer -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Jumlah Pembayaran </label>
                                    <input type="text" name="nominal" id="rupiah" class="form-control" placeholder="Nominal Pembayaran" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tgl Bayar : </label>
                                    <input type="text" name="tgl" class="form-control" id="datepic" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thn Ajaran </label>
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tahun");
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
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-primary pull-right"><span class="fa fa-save"></span> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="col-md-8">
                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-green">
                                <i class="fa fa-clock-o"></i> Thn. <?= $tahun; ?>
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <li>
                            <?php
                            $t1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 1' AND stts = '$st1' AND tahun = '$tahun' "));
                            $t2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 2' AND stts = '$st1' AND tahun = '$tahun' "));
                            $t3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 3' AND stts = '$st1' AND tahun = '$tahun' "));
                            $t4 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 4' AND stts = '$st1' AND tahun = '$tahun' "));

                            $h1 = $bayar_santri['jml'];
                            $h2 = $h1 - $t2['nominal'];
                            $h3 = $h2 - $t3['nominal'];
                            $h4 = $h3 - $t4['nominal'];
                            ?>
                            <i class="fa fa-money bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    <?= date("H:i", strtotime('+5 hours')) ?></span>
                                <h3 class="timeline-header"><a href="#">History Pembayaran Santri</a> (Tahun <?= $tahun; ?>)
                                </h3>
                                <div class="timeline-body">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><a href="#"><?= $t1['nama'] ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>(<?= $t1['bulan']; ?>)</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th><?= rupiah($t1['nominal']); ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <?php if ($h1 >= $t1['nominal']) { ?>
                                                    <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                <?php } else { ?>
                                                    <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                        Belum Lunas</th>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th><a href="#"><?= $t2['nama'] ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>(<?= $t2['bulan']; ?>)</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th><?= rupiah($t2['nominal']); ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <?php if ($h2 >= $t2['nominal']) { ?>
                                                    <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                <?php } else { ?>
                                                    <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                        Belum Lunas</th>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th><a href="#"><?= $t3['nama'] ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>(<?= $t3['bulan']; ?>)</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th><?= rupiah($t3['nominal']); ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <?php if ($h3 >= $t3['nominal']) { ?>
                                                    <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                <?php } else { ?>
                                                    <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                        Belum Lunas</th>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th><a href="#"><?= $t4['nama'] ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>(<?= $t4['bulan']; ?>)</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th><?= rupiah($t4['nominal']); ?></th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <?php if ($h4 >= $t4['nominal']) { ?>
                                                    <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                <?php } else { ?>
                                                    <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                        Belum Lunas</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary ">Total : <?= rupiah($byr['jml']); ?></a> -
                                    <a class="btn btn-warning ">Bayar : <?= rupiah($bayar_santri['jml']); ?> </a> =
                                    <a class="btn btn-danger ">Sisa :
                                        <?= rupiah($byr['jml'] - $bayar_santri['jml']); ?> </a>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Pembayaran Santri</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Bayar</th>
                                        <th>Nominal</th>
                                        <th>Untuk Tahun</th>
                                        <th>Penerima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($syh as $yh) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $yh["tgl"]; ?> </td>
                                            <td><?= rupiah($yh["nominal"]); ?></td>
                                            <td><?= $yh["tahun"]; ?></td>
                                            <td><?= $yh["kasir"]; ?></td>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </form>
        <?php
        }
        ?>
    </div>
</section>