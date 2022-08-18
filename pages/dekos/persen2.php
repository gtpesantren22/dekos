<?php

//use function PHPSTORM_META\map;

require 'function.php';
$bln = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");

?>
<section class="content-header">
    <h1>
        Persentase Hasil Dekosan
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default collapsed-box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Pilih Data</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post">
                        <?php
                        $jm = mysqli_query($conn, "SELECT * FROM setor GROUP BY tahun");
                        while ($a = mysqli_fetch_assoc($jm)) {
                            $ttt = $a['tahun'] ?>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Tahun <?= $a['tahun'] ?></label>
                                    <br>

                                    <?php
                                    $dt = mysqli_query($conn, "SELECT * FROM setor WHERE tahun = '$ttt' GROUP BY bulan");
                                    while ($b = mysqli_fetch_assoc($dt)) {
                                        $bb = $b['bulan'];
                                    ?>

                                        <div class="responsive-table">
                                            <table class="table">
                                                <tr>
                                                    <label for=""><?= $bln[$b['bulan']] ?></label><br>
                                                </tr>
                                                <?php
                                                $dt2 = mysqli_query($conn, "SELECT * FROM setor WHERE bulan = $bb AND tahun = '$ttt' ORDER BY dari ASC");
                                                while ($b2 = mysqli_fetch_assoc($dt2)) { ?>
                                                    <tr><input type="radio" name="data" id="" value="<?= $b2['id']; ?>" required> <?= $b2['dari'] ?> | </tr>
                                                <?php } ?>

                                            </table>
                                        </div>

                                    <?php } ?>

                                </div><!-- /.input group -->
                            </div>
                        <?php } ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cek" class="btn btn-block btn-flat bg-navy"><span class="fa fa-search">
                                        Tampilkan</span></button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <!-- Small boxes (Stat box) -->
    <?php if (isset($_POST['cek'])) {
        $d = $_POST['data'];
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM setor WHERE id = $d "));

        $bulan = $data['bulan'];
        $tahun = $data['tahun'];
        $tot2 = $data['nominal'];

        mysqli_query($conn, "DROP VIEW rekap");
        mysqli_query($conn, "DROP VIEW rekap2");

        mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, a.bulan, a.tahun, b.nama, b.nis FROM kos AS a 
                                   INNER JOIN kunci AS b ON a.nis = b.nis WHERE a.bulan = $bulan AND a.tahun = '$tahun' AND ket = 0 GROUP BY nis ORDER BY nominal ASC");

        mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis FROM kunci WHERE ket = 0 AND bulan = $bulan AND tahun = '$tahun'");
        $san = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kunci WHERE ket = 0 AND bulan = $bulan AND tahun = '$tahun' "));

        $lunas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 "));
        $belum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 "));
        $tak = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis) "));

        $p_lns = ($lunas / $san) * 100;
        $p_blm = ($belum / $san) * 100;
        $p_tak = ($tak / $san) * 100;

        $bl = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $jml_blm = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jml) AS tot FROM rekap WHERE jml < 300000 AND bulan = $bulan AND tahun = '$tahun' "));


        $dk = mysqli_query($conn, "SELECT * FROM setor WHERE tahun = '$tahun' AND bulan = $bulan ");
        $dkt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS nom FROM setor WHERE tahun = '$tahun' AND bulan = $bulan "));
        $bagi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM setor WHERE id = $d "))
    ?>
        <div class="row">
            <div class="col-lg-12 col-xs-6">
                <div class="color-palette-set">
                    <div class="bg-navy-active color-palette">
                        <h3 style="padding: 5px;"> Data Bulan : <?= $bl[$bulan]; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $san; ?></h3>
                        <p>Jml Santri Dekos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">Jml Santri Dekos <i class="fa fa-user"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= round($p_lns, 2); ?><sup style="font-size: 20px">%</sup></h3>
                        <p>: <?= $lunas; ?> santri</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Lunas <i class="fa fa-check"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= round($p_blm, 2); ?><sup style="font-size: 20px">%</sup></h3>
                        <p>: <?= $belum; ?> santri</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-refresh"></i>
                    </div>
                    <a href="#" class="small-box-footer">Belum Lunas <i class="fa fa-refresh"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= round($p_tak, 2); ?><sup style="font-size: 20px">%</sup></h3>
                        <p>: <?= $tak; ?> santri</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-close"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tak Bayar <i class="fa fa-close"></i></a>
                </div>
            </div><!-- ./col -->
        </div>
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-money"></i> Pendapatan Bulan ini
                        <small class="pull-right">Bulan : <?= $bl[$bulan] ?></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:30%">Total Pendapatan</th>
                                <th>:</th>
                                <th><?= $san; ?></th>
                                <td>x 300.000</td>
                                <th><?= rupiah($san * 300000); ?></th>
                            </tr>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>SETORAN</th>
                                    <th>BULAN</th>
                                    <th>JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($a = mysqli_fetch_assoc($dk)) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $a['dari'] ?></td>
                                        <td><?= $bl[$bulan] ?></td>
                                        <td><?= rupiah($a['nominal']) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <th colspan="3">TOTAL</th>
                                <th><?= rupiah($dkt['nom']) ?></th>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.col -->
                <!-- accepted payments column -->
                <div class="col-xs-4">
                    <p style="font-weight: bold;">Total Keseluruhan : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah($san * 300000); ?>
                    </h3>
                    <p style="font-weight: bold;">Sudah setor : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah($dkt['nom']); ?>
                    </h3>
                    <p style="font-weight: bold;">Sisa : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah(($san * 300000) - ($dkt['nom'])); ?>
                    </h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        </i> Pembagian Hasil :
                    </h2>
                </div><!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-solid box-warning">
                        <div class="box-header">
                            <h3 class="box-title">Rumus Persentase Jumlah Santri Dekos</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-md-1">
                                <span style="font-weight: bold;">&nbsp;</span><br>
                                <span style="font-weight: bold;">=</span><br>
                                <span style="font-weight: bold;">&nbsp;</span>
                            </div>
                            <div class="col-md-8">
                                <span style="font-weight: bold;">Jml santri dekos</span><br>
                                <span style="font-weight: bold;">------------------- x 100</span><br>
                                <span style="font-weight: bold;">Jml santri</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;">&nbsp;</span><br>
                                <span style="font-weight: bold;"> = ... %</span><br>
                                <span style="font-weight: bold;">&nbsp;</span>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box box-solid box-success">
                        <div class="box-header">
                            <h3 class="box-title">Rumus Jumlah Pendapatan</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-md-1">
                                <span style="font-weight: bold;">&nbsp;</span><br>
                                <span style="font-weight: bold;">=</span><br>
                                <span style="font-weight: bold;">&nbsp;</span>
                            </div>
                            <div class="col-md-8">
                                <span style="font-weight: bold;">Jml total dana</span><br>
                                <span style="font-weight: bold;">------------------- x Jml santri perdekosan</span><br>
                                <span style="font-weight: bold;">Jml santri</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-weight: bold;">&nbsp;</span><br>
                                <span style="font-weight: bold;"> = Rp. ...</span><br>
                                <span style="font-weight: bold;">&nbsp;</span>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <!-- ================================================================================================ -->
                <!-- PEMBAGIAN -->
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-purple">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">PEMBAGIAN HASIL DARI <b><i><?= $data['dari'] ?></i></b> BULAN <b><i><?= $bl[$bulan] . ' ' . $tahun; ?></i></b></h3>
                            <h5 class="widget-user-desc">untuk perdekosan</h5>
                        </div>
                    </div>
                    <div class="box-footer no-padding">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TEMPAT KOS</th>
                                        <th>JUMLAH SANTRI</th>
                                        <th>PERSENTASE (%)</th>
                                        <th>PENDAPATAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $tt = array('Dak ada', 'Ny. Jamilah', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naili', 'Ny. Lathifah');
                                    $ks = mysqli_query($conn, "SELECT t_kos, COUNT(*) as total
                                FROM kunci WHERE tahun = '$tahun' AND bulan = $bulan AND ket = 0 GROUP BY t_kos ");
                                    while ($pb = mysqli_fetch_assoc($ks)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $tt[$pb['t_kos']] ?></td>
                                            <td><?= $pb['total'] ?></td>
                                            <td><?= round(($pb['total'] / $san) * 100, 1) ?> %</td>
                                            <th><?= rupiah(($tot2 / $san) * $pb['total']) ?></th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <h3 class="text-muted well well-sm no-shadow bg-aqua" style="margin-top: 10px; font-weight: bold; text-align: center;">
                            <?= rupiah($tot2) ?>
                        </h3>
                    </div>
                </div><!-- /.widget-user -->

                <!-- ================================================================================================ -->
                <!-- DATA BULANAN -->
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">REKAPITULASI DANA DEKOSAN BULAN <b><i><?= $bl[$bulan] . ' ' . $tahun; ?></i></b></h3>
                            <h5 class="widget-user-desc">untuk perdekosan</h5>
                        </div>
                    </div>
                    <div class="box-footer no-padding">
                        <div class="table-responsive">
                            <table class="table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA PENERIMA</th>
                                        <th>JML SANTRI</th>
                                        <th style="color: white; background-color: green;">JML TOTAL DANA</th>
                                        <?php
                                        $st = mysqli_query($conn, "SELECT * FROM setor WHERE tahun = '$tahun' AND bulan = $bulan");
                                        while ($d_st = mysqli_fetch_assoc($st)) { ?>
                                            <th style="color: white; background-color: gray;"><?= strtoupper($d_st['dari']) ?></th>
                                        <?php } ?>
                                        <th style="color: white; background-color: lightseagreen;">DANA MASUK</th>
                                        <th colspan="2" style="color: white; background-color: red;">SISA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $tt = array('Dak ada', 'Ny. Jamilah', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naili', 'Ny. Lathifah');
                                    $sk = mysqli_query($conn, "SELECT t_kos, COUNT(*) as total
                                FROM kunci WHERE tahun = '$tahun' AND bulan = $bulan AND ket = 0 GROUP BY t_kos ");
                                    while ($d_sk = mysqli_fetch_assoc($sk)) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $tt[$d_sk['t_kos']] ?></td>
                                            <td><?= $d_sk['total'] ?></td>
                                            <th style="color: white; background-color: green;"><?= rupiah($d_sk['total'] * 300000) ?></th>
                                            <?php
                                            $nn = mysqli_query($conn, "SELECT nominal FROM setor WHERE tahun = '$tahun' AND bulan = $bulan");
                                            $nnt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS tot FROM setor WHERE tahun = '$tahun' AND bulan = $bulan"));
                                            while ($d_nn = mysqli_fetch_assoc($nn)) { ?>
                                                <th style=" background-color: lightgray;"><?= rupiah(($d_nn['nominal'] / $san) * $d_sk['total']) ?></th>
                                            <?php } ?>
                                            <th style="color: white; background-color: lightseagreen;"><?= rupiah(($nnt['tot'] / $san) * $d_sk['total']) ?></th>
                                            <th style="color: white; background-color: red;"><?= rupiah(($d_sk['total'] * 300000) - (($nnt['tot'] / $san) * $d_sk['total'])) ?></th>
                                            <th style="color: white; background-color: lightcoral;"><?php $dana = ($d_sk['total'] * 300000) - (($nnt['tot'] / $san) * $d_sk['total']);
                                                                                                    $hasil = ($dana / $nnt['tot']) * 100;
                                                                                                    echo round($hasil, 2); ?> %</th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <h3 class="text-muted well well-sm no-shadow bg-aqua" style="margin-top: 10px; font-weight: bold; text-align: center;">
                            <?= rupiah($nnt['tot']) ?>
                        </h3>
                    </div>
                </div><!-- /.widget-user -->
            </div><!-- /.col -->

        </section>
    <?php
    }
    ?>

</section><!-- /.content -->
<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tahun').change(function() { // Jika Select Box id provinsi dipilih
            var tahun = $(this).val(); // Ciptakan variabel provinsi
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: 'ajax/get_bulan.php', // File yang akan memproses data
                data: 'nama_prov=' + tahun, // Data yang akan dikirim ke file pemroses
                success: function(response) { // Jika berhasil
                    $('#bulan').html(response); // Berikan hasil ke id kota
                }
            });
        });
    });
</script>