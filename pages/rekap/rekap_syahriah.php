<?php
require 'function.php';
?>
<section class="content-header">
    <h1>
        Rekap Data Syahriah
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Rekap Harian</a></li>
                    <li><a href="#timeline" data-toggle="tab">Rekap Pertanggal</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <div class="box-header">
                                <center>
                                    <h3 class="box-title text-center">Rekap Data Harian</h3>
                                </center>
                            </div>
                            <div class="box-body">
                                <form action="" class="form-horizontal" method="post">
                                    <!-- Date range -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Pilih Tanggal : </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="tanggal1" class="form-control pull-right"
                                                    id="datepic" autocomplete="off" required>
                                            </div><!-- /.input group -->
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" name="cari1" class="btn bg-purple"><span
                                                    class="fa fa-search"></span>
                                                Tampilkan</button>
                                        </div>
                                    </div><!-- /.form group -->
                                </form>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['cari1'])) {
                            $tgl1 = $_POST['tanggal1'];
                            $dari1 = date("Y-m-d", strtotime($tgl1));

                        ?>
                        <form action="" method="post">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Data Tanggal :
                                        <br />
                                        <br />
                                        <p class="label label-success"> Putra</p> <p class="label label-primary"> <?= date('d F Y', strtotime($tgl1)); ?></p>
                                    </h3>
                                    <a href="<?= 'pages/rekap/excel_syahriah.php?tanggal=' . $dari1 ?>" target="_blank"
                                        type="button" class="btn bg-purple pull-right"><span
                                            class="fa  fa-file-excel-o">
                                        </span>
                                        Export to excel</a>
                                    <a href="<?= 'pages/rekap/print_syahriah.php?tanggal=' . $dari1 ?>" target="_balnk"
                                        type="button" class="btn btn-danger pull-right"><span class="fa fa-print">
                                        </span>
                                        Print</a>
                                </div>
                                <hr>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Nominal</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $syahriah1 = mysqli_query($conn, "SELECT a.*, b.* FROM syahriah a JOIN tb_santri b on a.nis=b.nis WHERE a.tgl = '$tgl1' AND b.jkl = 'Laki-laki' ");
                                                $total1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS total FROM syahriah a JOIN tb_santri b on a.nis=b.nis WHERE a.tgl = '$tgl1' AND b.jkl = 'Laki-laki' "));
                                                ?>
                                            <?php foreach ($syahriah1 as $r1) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r1["nis"]; ?> </td>
                                                <td><?= $r1["nama"]; ?> </td>
                                                <td><?= date("d-M-Y", strtotime($r1["tgl"])); ?> </td>
                                                <td><?= rupiah($r1["nominal"]); ?></td>
                                                <td><?= $r1["kasir"]; ?> </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <h3 class="text-center"><label class="label label-warning"> JUMLAH TOTAL
                                            PENGELUARAN :
                                            <?= rupiah($total1['total']); ?></label></h3>
                                </div><!-- /.box-footer -->
                            </div>
                            
                            <!--Data Putri-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Data Tanggal :
                                        <br />
                                        <br />
                                        <p class="label label-danger"> Putri</p> <p class="label label-primary"> <?= date('d F Y', strtotime($tgl1)); ?></p>
                                    </h3>
                                    <a href="<?= 'pages/rekap/excel_syahriah.php?tanggal=' . $dari1 ?>" target="_blank"
                                        type="button" class="btn bg-purple pull-right"><span
                                            class="fa  fa-file-excel-o">
                                        </span>
                                        Export to excel</a>
                                    <a href="<?= 'pages/rekap/print_syahriah.php?tanggal=' . $dari1 ?>" target="_balnk"
                                        type="button" class="btn btn-danger pull-right"><span class="fa fa-print">
                                        </span>
                                        Print</a>
                                </div>
                                <hr>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Nominal</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $syahriah1 = mysqli_query($conn, "SELECT a.*, b.* FROM syahriah a JOIN tb_santri b on a.nis=b.nis WHERE a.tgl = '$tgl1' AND b.jkl = 'Perempuan' ");
                                                $total1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS total FROM syahriah a JOIN tb_santri b on a.nis=b.nis WHERE a.tgl = '$tgl1' AND b.jkl = 'Perempuan' "));
                                                ?>
                                            <?php foreach ($syahriah1 as $r1) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r1["nis"]; ?> </td>
                                                <td><?= $r1["nama"]; ?> </td>
                                                <td><?= date("d-M-Y", strtotime($r1["tgl"])); ?> </td>
                                                <td><?= rupiah($r1["nominal"]); ?></td>
                                                <td><?= $r1["kasir"]; ?> </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <h3 class="text-center"><label class="label label-warning"> JUMLAH TOTAL
                                            PENGELUARAN :
                                            <?= rupiah($total1['total']); ?></label></h3>
                                </div><!-- /.box-footer -->
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <div class="post">
                            <div class="box-header">
                                <center>
                                    <h3 class="box-title">Rekap Berdasarkan Tanggal</h3>
                                </center>
                            </div>
                            <div class="box-body">
                                <form action="" class="form-horizontal" method="post">
                                    <!-- Date range -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Pilih Tanggal : </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="tanggal" class="form-control pull-right"
                                                    id="reservation" autocomplete="off" required>
                                            </div><!-- /.input group -->
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" name="cari" class="btn bg-purple"><span
                                                    class="fa fa-search"></span>
                                                Tampilkan</button>
                                        </div>
                                    </div><!-- /.form group -->
                                </form>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['cari'])) {
                            $tgl = $_POST['tanggal'];
                            $tg = explode(" - ", $tgl);
                            $dari = date("Y-m-d", strtotime($tg[0]));
                            $sampai = date("Y-m-d", strtotime($tg[1]));

                        ?>
                        <form action="" method="post">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Data Tanggal :
                                        <br />
                                        <br />
                                        <p class="label label-primary"> <?= date('d F Y', strtotime($tg[0])); ?></p>
                                        s/d
                                        <p class="label label-primary"> <?= date('d F Y', strtotime($tg[1])); ?></p>
                                    </h3>
                                    <a href="<?= 'pages/rekap/excel_syahriah.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                                        target="_blank" type="button" class="btn bg-purple pull-right"><span
                                            class="fa  fa-file-excel-o">
                                        </span>
                                        Export to excel</a>
                                    <a href="<?= 'pages/rekap/print_syahriah.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                                        target="_balnk" type="button" class="btn btn-danger pull-right"><span
                                            class="fa fa-print">
                                        </span>
                                        Print</a>
                                </div>
                                <hr>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                $syahriah = mysqli_query($conn, "SELECT * FROM syahriah WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER by id ASC");
                                                $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM syahriah WHERE tgl BETWEEN '$dari' AND '$sampai' "));
                                                ?>
                                            <?php foreach ($syahriah as $r) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r["nis"]; ?> </td>
                                                <td><?= $r["nama"]; ?> </td>
                                                <td><?= $r["tgl"]; ?> </td>
                                                <td><?= rupiah($r["nominal"]); ?></td>
                                                <td><?= $r["kasir"]; ?> </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <h3 class="text-center"><label class="label label-warning"> JUMLAH TOTAL
                                            PENGELUARAN :
                                            <?= rupiah($total['total']); ?></label></h3>
                                </div><!-- /.box-footer -->
                            </div>
                        </form>
                        <?php
                        }
                        ?>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div>
</section>