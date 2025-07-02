
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
                        <div class="col-md-5">
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
                        <div class="col-md-5">
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
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        mysqli_query($conn, "DROP VIEW rekap");
        mysqli_query($conn, "DROP VIEW rekap2");

        mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, a.bulan, a.tahun, b.nama, b.nis, b.k_formal, b.t_formal, b.jkl FROM kos AS a 
                                   INNER JOIN tb_santri AS b ON a.nis = b.nis WHERE a.bulan = $bulan AND a.tahun = '$tahun' AND ket = 0 GROUP BY nis ORDER BY nominal ASC");

        mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis, k_formal, t_formal, jkl FROM tb_santri WHERE ket = 0 ");
        $san = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = 0 "));

        $lunas = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 "));
        $belum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 "));
        $tak = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis) "));

        $p_lns = ($lunas / $san) * 100;
        $p_blm = ($belum / $san) * 100;
        $p_tak = ($tak / $san) * 100;

        $bl = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $jml_blm = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jml) AS tot FROM rekap WHERE jml < 300000 AND bulan = $bulan AND tahun = '$tahun' "));

        $nj = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 1 AND ket = 0"));
        $gz = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 2 AND ket = 0"));
        $nf = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 3 AND ket = 0"));
        $nz = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 4 AND ket = 0"));
        $ns = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 5 AND ket = 0"));
        $nm = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 6 AND ket = 0"));
        $nn = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 7 AND ket = 0"));
        $nl = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = 8 AND ket = 0"));

        $lunas_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 AND jkl = 'Laki-laki' "));
        //$belum_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 AND jkl = 'Laki-laki'"));
        $lunas_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 300000 AND jkl = 'Perempuan'"));
        // $belum_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 300000 AND jkl = 'Perempuan'"));
        $jml_blm_pa = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jml) AS tot FROM rekap WHERE jml < 300000 AND bulan = $bulan AND tahun = '$tahun' AND jkl = 'Laki-laki' "));
        $jml_blm_pi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jml) AS tot FROM rekap WHERE jml < 300000 AND bulan = $bulan AND tahun = '$tahun' AND jkl = 'Perempuan' "));
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
                        <i class="fa fa-money"></i> Pendapatan
                        <small class="pull-right">Bulan : <?= $bl[$bulan] ?></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:30%">Lunas</th>
                                <th>:</th>
                                <th><?= $lunas; ?></th>
                                <td>x 300.000</td>
                                <th><?= rupiah($lunas * 300000); ?></th>
                            </tr>
                            <tr>
                                <th>Belum Lunas</th>
                                <th>:</th>
                                <th><?= $belum; ?></th>
                                <td></td>
                                <th><?= rupiah($jml_blm['tot']); ?></th>
                            </tr>
                        </table>
                    </div>
                </div><!-- /.col -->
                <!-- accepted payments column -->
                <div class="col-xs-4">
                    <p style="font-weight: bold;">Total Keseluruhan : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah(($lunas * 300000) + $jml_blm['tot']); ?>
                    </h3>
                    <p style="font-weight: bold;">Total Putra : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah(($lunas_pa * 300000) + $jml_blm_pa['tot']); ?>
                    </h3>
                    <p style="font-weight: bold;">Total Putri : </p>
                    <h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-weight: bold; text-align: center;">
                        <?= rupiah(($lunas_pi * 300000) + $jml_blm_pi['tot']); ?>
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
                                <span style="font-weight: bold;">Jumlah santri dekos</span><br>
                                <span style="font-weight: bold;">-------------------------------- x 100</span><br>
                                <span style="font-weight: bold;">Jumlah santri</span>
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
                                <span style="font-weight: bold;">Jumlah total </span><br>
                                <span style="font-weight: bold;">-------------------------------- x Jml santri
                                    dekos</span><br>
                                <span style="font-weight: bold;">Jumlah santri</span>
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
                <!-- NY. JAMILAH -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-purple">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. JAMILAH</h3>
                            <h5 class="widget-user-desc">Santri putra</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nj; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nj / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nj; ?></span></a>
                                </li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-aqua" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nj);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- GUS ZAINI -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-purple">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar5.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">GUS ZAINI</h3>
                            <h5 class="widget-user-desc">Santri putra</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $gz; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($gz / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $gz ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-aqua" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $gz);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. FARIHAH -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-purple">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. FARIHAH</h3>
                            <h5 class="widget-user-desc">Santri putra</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nf; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nf / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nf ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-aqua" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nf);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. LATHIFAH -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. LATHIFAH</h3>
                            <h5 class="widget-user-desc">Santri putri</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nl; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nl / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nl ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-orange" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nl);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. ZAHRO -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. ZAHRO</h3>
                            <h5 class="widget-user-desc">Santri putri</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nz; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nz / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nz ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-orange" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nz);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. SA'ADAH -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. SA'ADAH</h3>
                            <h5 class="widget-user-desc">Santri putri</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $ns; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($ns / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $ns ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-orange" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $ns);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. MAMJUDAH -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. MAMJUDAH</h3>
                            <h5 class="widget-user-desc">Santri putri</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nm; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nm / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nm ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-orange" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nm);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

                <!-- ================================================================================================ -->
                <!-- NY. NAILY ZULFA-->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-maroon">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/avatar2.png" alt="User Avatar">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username">NY. NAILY ZULFA</h3>
                            <h5 class="widget-user-desc">Santri putri</h5>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h2 class="description-header"><?= $nn; ?></h2>
                                        <span class="description-text">Jml santri</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header"> <?= round((($nn / $san) * 100), 2);  ?> %
                                        </h5>
                                        <span class="description-text">PERSENTASE</span>
                                    </div><!-- /.description-block -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Jml Santri <span class="pull-right badge bg-blue"><?= $nn ?></span></a></li>
                                <li><a href="#">Harga <span class="pull-right badge bg-green">Rp. 300.000</span></a>
                                </li>
                            </ul>
                            <h3 class="text-muted well well-sm no-shadow bg-orange" style="margin-top: 10px; font-weight: bold; text-align: center;">
                                <?php $tot = ($lunas * 300000) + $jml_blm['tot'];
                                echo rupiah(($tot / $san) * $nn);
                                ?>
                            </h3>
                        </div>
                    </div><!-- /.widget-user -->
                </div><!-- /.col -->

            </div>
        </section>
    <?php
    }
    ?>

</section><!-- /.content -->