<?php
require 'function.php';
$masuk =  query("SELECT * FROM keluar a JOIN item b ON a.item=b.id_item ");
$jum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM keluar"))
?>
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Data Pengeluaran
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
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pengeluaran</span>
                    <span class="info-box-number"><?= rupiah($jum['total']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Jumlah Pemasukan per - <?= date("d F Y") ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Data Seluruh Pengeluaran</h3>
                    <a href="index.php?link=pages/pengeluaran/add" type="button" class="btn btn-danger pull-right"><span class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>No. Nota</th>
                                <th>Uraian</th>
                                <th>Penjab</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Bukti Nota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($masuk as $r) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r["nama_i"]; ?> </td>
                                    <td><?= $r["no_nota"]; ?> </td>
                                    <td><?= $r["nama"]; ?> </td>
                                    <td><?= $r["pemohon"]; ?> </td>
                                    <td><?= rupiah($r["nominal"]); ?></td>
                                    <td><?= date("d-M-Y", strtotime($r["tgl"])); ?> </td>
                                    <td><img src="img/<?= $r["foto"]; ?>" width="50"> </td>
                                    <td><a href="<?= 'index.php?link=pages/pengeluaran/edit&kode=' . $r["kode"]; ?>"><button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                        <a href="<?= 'index.php?link=pages/pengeluaran/del&kode=' . $r["kode"]; ?>" onclick="return confirm('Yakin Akan dihapus ?')"><button class="btn btn-danger btn-xs">Hapus</button></a></td>
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