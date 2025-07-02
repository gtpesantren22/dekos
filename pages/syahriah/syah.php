<?php

$masuk =  query("SELECT * FROM syahriah ORDER by id ASC");
$jum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM syahriah"))
?>
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Data Pembyaran Syahriah
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
            <div class="info-box bg-purple">
                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pembayaran Syahriah</span>
                    <span class="info-box-number"><?= rupiah($jum['total']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Jumlah Pemasukan per - <?= date("d F Y") ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Seluruh Pembayaran Syahriah</h3>
                    <a href="index.php?link=pages/syah" type="button" class="btn bg-purple pull-right"><span
                            class="fa fa-plus-circle">
                        </span>
                        Tambah Data </a>
                    <a href="index.php?link=pages/cek" type="button" class="btn bg-olive pull-right"><span
                            class="fa fa-search">
                        </span>
                        Cek History Pembayaran Santri</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal</th>
                                <th>Tahun Ajaran</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($masuk as $r) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $r["nama"]; ?> </td>
                                <td><?= date("d-M-Y", strtotime($r["tgl"])); ?> </td>
                                <td><?= rupiah($r["nominal"]); ?></td>
                                <td><?= $r["tahun"]; ?> </td>
                                <td>Ust. <?= $r["kasir"]; ?></td>
                                <td><a href="<?= 'index.php?link=pages/syahriah/edit&id=' . $r["id"]; ?>"><button
                                            type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                    <a href="<?= 'index.php?link=pages/syahriah/del&id=' . $r["id"]; ?>"
                                        onclick="return confirm('Yakin Akan dihapus ?')"><button
                                            class="btn btn-danger btn-xs">Hapus</button></a></td>
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