<?php
require 'function.php';
$masuk =  query("SELECT * FROM tahun ORDER by id ASC");
?>
<section class="content-header">
    <h1><span class="fa fa-hourglass-half"> </span>
        Data Tahun Ajaran
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Tahun Ajaran</h3>
                    <a href="index.php?link=pages/tahun/add" type="button" class="btn btn-primary pull-right"><span
                            class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($masuk as $r) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $r["nama"]; ?> </td>
                                <td><a href="<?= 'index.php?link=pages/tahun/edit&id=' . $r["id"]; ?>"><button
                                            type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>
                                    <a href="<?= 'index.php?link=pages/tahun/del&id=' . $r["id"]; ?>"
                                        onclick="return confirm('Yakin Akan dihapus ?')"><button
                                            class="btn btn-danger btn-xs">Hapus</button></a></td>
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