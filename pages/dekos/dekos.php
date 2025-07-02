<?php

$dekos =  query("SELECT A.id, nominal, bulan, tahun, tgl, nama, jkl FROM kos A JOIN tb_santri B ON A.nis=B.nis WHERE tahun = '2024/2025' ORDER BY tgl ASC");
// $dekos =  query("SELECT a.nominal, a.bulan, a.tahun, a.tgl, b.nama, b.nis, b.k_formal, b.t_formal, b.jkl FROM kos AS a 
// INNER JOIN tb_santri AS b ON a.nis = b.nis WHERE a.bulan = 10  AND b.jkl = 'Perempuan' AND a.nominal = 120000 ");
$setor =  query("SELECT * FROM setor ORDER BY tgl DESC LIMIT 5");
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
                                    <th>Nominal</th>
                                    <th>Untuk Bulan</th>
                                    <th>Tgl Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dekos as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r["nama"]; ?> </td>
                                        <td><?= rupiah($r["nominal"]); ?></td>
                                        <td><?= bulan($r['bulan']); ?> <?= $r["tahun"]; ?></td>
                                        <td><?= date("d-m-Y", strtotime($r["tgl"])); ?> </td>
                                        <td><a href="<?= 'index.php?link=pages/dekos/edit&id=' . $r["id"]; ?>"><button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                            <a href="<?= 'index.php?link=pages/dekos/del&id=' . $r["id"]; ?>" onclick="return confirm('Yakin Akan dihapus ?')"><button class="btn btn-danger btn-xs">Hapus</button></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
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