<?php
require 'function.php';
?>
<section class="content-header">
    <h1>
        Rekap Data Pengeluaran
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
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"></h3>
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
                                    <input type="text" name="tanggal" class="form-control pull-right" id="reservation"
                                        autocomplete="off" required>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" name="cari" class="btn btn-danger"><span
                                        class="fa fa-search"></span>
                                    Tampilkan</button>
                            </div>
                        </div><!-- /.form group -->
                    </form>
                </div>
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
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">
                            Data Tanggal :
                            <br />
                            <br />
                            <p class="label label-danger"> <?= date('d F Y', strtotime($tg[0])); ?></p> s/d
                            <p class="label label-danger"> <?= date('d F Y', strtotime($tg[1])); ?></p>
                        </h3>
                        <a href="<?= 'pages/rekap/excel_keluar.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                            target="_blank" type="button" class="btn btn-success pull-right"><span
                                class="fa  fa-file-excel-o">
                            </span>
                            Export to excel</a>
                        <a href="<?= 'pages/rekap/print_keluar.php?dari=' . $dari . '&sampai=' . $sampai ?>"
                            target="_balnk" type="button" class="btn btn-danger pull-right"><span class="fa fa-print">
                            </span>
                            Print</a>
                    </div>
                    <hr>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. Nota</th>
                                    <th>Pemohon</th>
                                    <th>Pengurus Bagian</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Terima</th>
                                    <th>Penerima</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 1;
                                    $keluar = mysqli_query($conn, "SELECT * FROM keluar WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER by id ASC");
                                    $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM keluar WHERE tgl BETWEEN '$dari' AND '$sampai' "));
                                    ?>
                                <?php foreach ($keluar as $r) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r["nama"]; ?> </td>
                                    <td><?= $r["no_nota"]; ?> </td>
                                    <td><?= $r["pemohon"]; ?> </td>
                                    <td><?= $r["bagian"]; ?> </td>
                                    <td><?= rupiah($r["nominal"]); ?></td>
                                    <td><?= $r["tgl"]; ?> </td>
                                    <td><?= $r["kasir"]; ?> </td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <h3 class="text-center"><label class="label label-warning"> JUMLAH TOTAL PENGELUARAN :
                                <?= rupiah($total['total']); ?></label></h3>
                    </div><!-- /.box-footer -->
                </div>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</section>