<?php
require 'function.php';
// $setor =  query("SELECT bulan, COUNT(CASE WHEN t_kos = 1 THEN 1 END) nj,
//                                 COUNT(CASE WHEN t_kos = 2 THEN 1 END) gz,
//                                 COUNT(CASE WHEN t_kos = 3 THEN 1 END) nf,
//                                 COUNT(CASE WHEN t_kos = 4 THEN 1 END) nz,
//                                 COUNT(CASE WHEN t_kos = 5 THEN 1 END) ns,
//                                 COUNT(CASE WHEN t_kos = 6 THEN 1 END) nm,
//                                 COUNT(CASE WHEN t_kos = 7 THEN 1 END) nn,
//                                 COUNT(CASE WHEN t_kos = 8 THEN 1 END) nl,
//                                 COUNT(CASE WHEN t_kos = '' THEN 1 END) ks,
//                                 COUNT(*) AS total, tahun
//                                 FROM kunci WHERE ket = 0 GROUP BY bulan ");
$bln = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Data Kunci Jumlah Santri Dekos
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
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Data Jumlah Santri Dekos</h3>
                    <a href="index.php?link=pages/kunci/add">
                        <button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data Baru</button>
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <?php foreach ($sql_tmp as $sq) : ?>
                                    <th><?= $sq['nama']; ?></th>
                                    <?php endforeach; ?>
                                    <th>Total</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $str = mysqli_query($conn, "SELECT *, COUNT(*) AS total FROM kunci GROUP BY bulan");
                                foreach ($str as $r) :
                                    $bull = $r['bulan'];
                                    $thh = $r['tahun'];
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $bln[$r["bulan"]] . ' ' . $r["tahun"]; ?> </td>
                                    <?php foreach ($sql_tmp as $sq) :
                                            $ttks = $sq['kd_tmp'];
                                            $tlt = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kunci WHERE bulan = $bull AND tahun = '$thh' AND t_kos = '$ttks' "));
                                        ?>
                                    <td><?= $tlt; ?></td>
                                    <?php endforeach; ?>
                                    <td><?= $r['total'] ?></td>
                                    <td><a
                                            href="<?= 'index.php?link=pages/kunci/detail&bln=' . $r["bulan"] . '&thn=' . $r['tahun']; ?>"><button
                                                type="submit" name="edit" class="btn btn-info btn-xs">Lihat</button></a>
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