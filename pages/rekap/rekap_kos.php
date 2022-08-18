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
                            <label class="col-sm-1 control-label">Tanggal : </label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal" class="form-control pull-right" id="reservation" autocomplete="off" required>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
                                    <select name="jkl" id="" class="form-control" required>
                                        <option value=""> -- pilih -- </option>
                                        <option value="Laki-laki"> Putra </option>
                                        <option value="Perempuan"> Putri </option>
                                        <option value="all"> Semua santri </option>
                                    </select>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-1">
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
            $tgl = $_POST['tanggal'];
            $jk = $_POST['jkl'];

            $tg = explode(" - ", $tgl);
            $dari = date("m/d/Y", strtotime($tg[0]));
            $sampai = date("m/d/Y", strtotime($tg[1]));

        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                Data Tanggal :
                                <br />
                                <br />
                                <p class="label label-primary"> <?= date('d F Y', strtotime($tg[0])); ?></p> s/d
                                <p class="label label-primary"> <?= date('d F Y', strtotime($tg[1])); ?></p> -
                                <p class="label label-warning"><?= $jk; ?></p>
                            </h3>
                            <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                                </span>
                                Download excel</a>
                            <a href="<?= 'pages/setor/add.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_balnk" type="button" class="btn btn-danger pull-right"><span class="fa fa-check">
                                </span>
                                Input Setor</a>
                        </div>
                        <hr>
                        <div class="box-body">
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
                                    if ($jk == 'all') {
                                        $masuk = mysqli_query($conn, "SELECT tgl, SUM(nominal) AS total FROM kos WHERE tgl BETWEEN '$dari' AND '$sampai' GROUP BY tgl ASC");
                                        $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos WHERE tgl BETWEEN '$dari' AND '$sampai' "));
                                    } else {
                                        $masuk = mysqli_query($conn, "SELECT a.tgl, SUM(a.nominal) AS total, b.jkl FROM kos AS a INNER JOIN tb_santri AS b ON a.nis=b.nis WHERE b.jkl = '$jk' AND a.tgl BETWEEN '$dari' AND '$sampai' GROUP BY tgl ASC");
                                        $total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS total FROM kos AS a INNER JOIN tb_santri AS b ON a.nis=b.nis WHERE b.jkl = '$jk' AND a.tgl BETWEEN '$dari' AND '$sampai' "));
                                    }
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
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <h3 class="text-center"><label class="label label-warning"> JUMLAH TOTAL PEMSUKAN :
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