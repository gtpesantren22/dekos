<?php
require 'function.php';
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Rekap Data Dekosan
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
                            <label class="col-sm-1 control-label">Pilih : </label>
                            <!-- <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal" class="form-control pull-right" id="reservation"
                                        autocomplete="off" required>
                                </div>
                            </div> -->
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
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
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
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
            //$tgl = $_POST['tanggal'];
            $tahun = $_POST['tahun'];
            $bulan = $_POST['bulan'];

            $bln = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
            $tt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS tt1 FROM kos WHERE bulan = $bulan  "));
            $nomm = $tt['tt1'];

            $masuk = mysqli_query($conn, "SELECT tgl, bulan, SUM(nominal) AS total FROM kos WHERE bulan = $bulan AND tahun = '$tahun' GROUP BY tgl ASC");
            $pa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT a.tgl, a.bulan, a.tahun, SUM(a.nominal) AS total, b.jkl FROM kos AS a INNER JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = $bulan AND tahun = '$tahun' AND jkl = 'Laki-laki' "));
            $pi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT a.tgl, a.bulan, a.tahun, SUM(a.nominal) AS total, b.jkl FROM kos AS a INNER JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = $bulan AND tahun = '$tahun' AND jkl = 'Perempuan' "));
            $str = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(pa) AS pa, SUM(pi) AS pi, bulan FROM setor WHERE bulan = $bulan AND tahun = '$tahun' GROUP BY bulan ASC"));
            
            $spa = $pa['total'] - $str['pa'];
            $spi = $pi['total'] - $str['pi'];
        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                Data Tanggal :
                                <br />
                                <br />
                                <p class="label label-warning"><?= $bln[$bulan]; ?></p> -
                                <p class="label label-info"><?= $tahun; ?></p>
                            </h3>
                            <a href="<?= 'pages/rekap/excel_kos.php?pa=' . $spa . '&pi=' . $spi . 'bulan=' . $bulan . '&tahun=' . $tahun  ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                                </span>
                                Download excel</a>
                            <a href="<?= 'pages/setor/add.php?pa=' . $spa . '&pi=' . $spi . '&bulan=' . $bulan . '&tahun=' . $tahun   ?>" target="_balnk" type="button" class="btn btn-danger pull-right"><span class="fa fa-check">
                                </span>
                                Input Setor</a>
                        </div>
                        <hr>
                        <div class="box-body">
                            <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Uraian</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    <?php foreach ($masuk as $r) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= date("d/m/Y", strtotime($r["tgl"])); ?> </td>
                                            <td>Dekosan </td>
                                            <td><?= rupiah($r["total"]); ?></td>
                                            <td>- </td>
                                            <td> </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bordered Table</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Data dari</th>
                                    <th>Jumlah</th>
                                    <th>Sudah Setor</th>
                                    <th>Sisa</th>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>Santri Putra</td>
                                    <td><?= rupiah($pa['total']) ?></td>
                                    <td><?= rupiah($str['pa']) ?></td>
                                    <td><?= rupiah($pa['total'] - $str['pa']) ?></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Santri Putri</td>
                                    <td><?= rupiah($pi['total']) ?></td>
                                    <td><?= rupiah($str['pi']) ?></td>
                                    <td><?= rupiah($pi['total'] - $str['pi']) ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th><?= rupiah($pa['total'] + $pi['total']) ?></th>
                                    <th><?= rupiah($str['pa'] + $str['pi']) ?></th>
                                    <th><?= rupiah(($pa['total'] - $str['pa']) + ($pi['total'] - $str['pi'])) ?></th>
                                </tr>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-4">
                    <div class="box-footer">
                        <h3 class="text-center"><label class="label label-warning"> JUMLAH SETORAN HARI INI : <br /><br />&nbsp;
                                <?= rupiah(($pa['total'] - $str['pa']) + ($pi['total'] - $str['pi'])); ?></label></h3>
                    </div><!-- /.box-footer -->
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</section>