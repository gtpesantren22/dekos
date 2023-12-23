<?php
require 'function.php';
$tks = $_GET['tks'];

$dt = mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND t_kos = $tks GROUP BY ket ");

$bl = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
$tt = array('Dak ada', 'Ny. Jamilah', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naili', 'Ny. Lathifah');
$kt = array('Bayar', 'Ust/Ustdz', 'Khaddam', 'Gratis', 'Berhenti');

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
                    <h3 class="box-title">Data dekos di <?= $tt[$tks] ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    while ($dd = mysqli_fetch_assoc($dt)) {
                    ?>
                        <h3 class="box-title">Data <?= $kt[$dd['ket']] ?></h3>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $k = $dd['ket'];

                                    $st = mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = $k AND aktif = 'Y' AND t_kos = $tks ");
                                    while ($r = mysqli_fetch_assoc($st)) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $r['nis'] ?></td>
                                            <td><?= $r['nama'] ?></td>
                                            <td><?= $r['desa'] . '-' . $r['kec'] . '-' . $r['kab'] ?></td>
                                            <td><?= $r['k_formal'] . '-' . $r['r_formal'] . '-' . $r['jurusan'] . '-' . $r['t_formal'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    <?php } ?>
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