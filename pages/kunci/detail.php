<?php
require 'function.php';
$bln = $_GET['bln'];
$thn = $_GET['thn'];

$setor = mysqli_query($conn, "SELECT a.t_kos, a.bulan, a.tahun, b.nama, COUNT(*) as total, 
                                    COUNT(CASE WHEN a.ket = 0 THEN 1 END) bayar,
                                    COUNT(CASE WHEN a.ket = 1 THEN 1 END) ustd,
                                    COUNT(CASE WHEN a.ket = 2 THEN 1 END) khaddam,
                                    COUNT(CASE WHEN a.ket = 3 THEN 1 END) gratis,
                                    COUNT(CASE WHEN a.ket = 4 THEN 1 END) mhs 
                                    FROM kunci a JOIN tempat b ON a.t_kos=b.kd_tmp WHERE a.bulan = $bln AND a.tahun = '$thn' GROUP BY a.t_kos");

$bl = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
$tt = array('Dak ada', 'Ny. Jamilah', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naili', 'Ny. Lathifah');
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
                    <h3 class="box-title">Detail Data Bulan <?= $bl[$bln] . ' ' . $thn ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tempat</th>
                                    <th>Santri Bayar</th>
                                    <th>Ust/Ustdz</th>
                                    <th>Khaddam</th>
                                    <th>Gratis</th>
                                    <th>Total</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($r = mysqli_fetch_assoc($setor)) {
                                    $tks = $r['t_kos'];
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $r['nama'] ?></td>
                                        <td><?= $r['bayar'] ?></td>
                                        <td><?= $r['ustd'] ?></td>
                                        <td><?= $r['gratis'] ?></td>
                                        <td><?= $r['khaddam'] ?></td>
                                        <td><?= $r['total'] ?></td>
                                        <td><a href="<?= 'index.php?link=pages/kunci/detail2&bln=' . $r["bulan"] . '&thn=' . $r['tahun'] . '&tks=' . $r['t_kos']; ?>"><button class="btn btn-success btn-xs"><i class="fa fa-users"></i> Lihat Santri</button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
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