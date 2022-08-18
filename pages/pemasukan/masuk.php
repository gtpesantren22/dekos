<?php
require 'function.php';
$masuk =  query("SELECT * FROM masuk a JOIN item b ON a.item=b.id_item");
$jum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM masuk"))
?>
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Data Pemasukan
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
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pemasukan</span>
                    <span class="info-box-number"><?= rupiah($jum['total']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Jumlah Pemasukan per - <?= date("d F Y") ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Data Seluruh Santri</h3>
                    <a href="index.php?link=pages/pemasukan/add" type="button" class="btn btn-success pull-right"><span class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Uraian</th>
                                <th>Nominal</th>
                                <th>Tanggal Terima</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($masuk as $r) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r["kode_i"] . ' - ' . $r["nama_i"]; ?> </td>
                                    <td><?= $r["nama"]; ?> </td>
                                    <td><?= rupiah($r["nominal"]); ?></td>
                                    <td><?= $r["tgl"]; ?> </td>
                                    <td><?= $r["penerima"]; ?> </td>
                                    <td><a href="<?= 'index.php?link=pages/pemasukan/edit&kode=' . $r["kode"]; ?>"><button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                        <a href="<?= 'index.php?link=pages/pemasukan/del&kode=' . $r["kode"]; ?>" onclick="return confirm('Yakin Akan dihapus ?')"><button class="btn btn-danger btn-xs">Hapus</button></a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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