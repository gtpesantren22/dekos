<?php
$jum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos"));
$jum2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM setor"));
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Data Pembayaran Dekosan
        <small>advanced tables</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-money-check-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo Dekosan</span>
                    <span class="info-box-number"><?= rupiah($jum['total'] - $jum2['total']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        * Saldo Dekosan = Jumlah Pemasukan - Jumlah Sotoran
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Data Pembayaran Dekosan</h3>
                    <!-- <a href="index.php?link=pages/dekos/add" type="button" class="btn btn-success pull-right"><span
                            class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a></a> -->
                    <div class="btn-group pull-right">
                        <a href="index.php?link=pages/setor/setor"><button type="button" class="btn btn-danger"><span class="fa fa-book"></span> Cek Data Setoran</button></a>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="index.php?link=pages/dekos/add"><button type="button" class="btn btn-success"><span class="fa fa-plus-circle"></span> Tambah Data</button></a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tempat Kos</th>
                                    <th>Nominal</th>
                                    <th>Untuk Bulan</th>
                                    <th>Tgl Bayar</th>
                                    <th>Ket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
    $(function() {
        $("#example1").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "ajax/dekos_data.php",
                "type": "POST"
            },
            "columns": [
                { "orderable": false }, // No
                { "orderable": true },  // Nama
                { "orderable": true },  // Tempat Kos
                { "orderable": true },  // Nominal
                { "orderable": true },  // Untuk Bulan
                { "orderable": true },  // Tgl Bayar
                { "orderable": true },  // Ket
                { "orderable": false }  // Aksi
            ]
        });
    });
</script>