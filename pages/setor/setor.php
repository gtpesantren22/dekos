<?php
require 'function.php';
$setor =  query("SELECT * FROM setor ORDER BY tgl DESC ");
$jum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos"));
$jum2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM setor"));
$bln = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Data Setoran
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
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-cash-register"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Setoran</span>
                    <span class="info-box-number"><?= rupiah($jum2['total']); ?></span>
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
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Uraian</th>
                                    <th>Bulan</th>
                                    <th>Nominal</th>
                                    <th>Tgl Setor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($setor as $r) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r["nama"]; ?> </td>
                                        <td><?= $r["sampai"]; ?></td>
                                        <td><?= $bln[$r["bulan"]] . " " . $r["tahun"]; ?></td>
                                        <td><?= rupiah($r["nominal"]); ?>
                                        </td>
                                        <td><?= date("d-m-Y", strtotime($r["tgl"])); ?> </td>
                                        <td><a href="<?= 'index.php?link=pages/setor/edit&id=' . $r["id"]; ?>"><button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                            <a href="<?= 'index.php?link=pages/setor/del&id=' . $r["id"]; ?>" onclick="return confirm('Yakin Akan dihapus ?')"><button class="btn btn-danger btn-xs">Hapus</button></a>
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