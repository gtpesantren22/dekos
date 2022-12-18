<?php
require 'function.php';

$kd = $_GET['id'];
$santri =  query("SELECT a.*, b.nama, b.k_formal, b.t_formal FROM kosmen a JOIN tb_santri b ON a.nis=b.nis WHERE b.aktif = 'Y' AND a.t_kos = $kd AND b.ket = 0 ");
$tt = array('Dak ada', 'Ny. Jamilah', 'Gus Zaini', 'Ny. Farihah', 'Ny. Zahro', 'Ny. Saadah', 'Ny. Mamjudah', 'Ny. Naili', 'Ny. Lathifah', 'Ny. Umi Kultsum');
?>
<section class="content-header">
    <h1>
        Data Dekosan
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
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rolling Data Dekosan</h3>
                    <!-- <a href="index.php?link=pages/add" type="button" class="btn btn-success pull-right"><span
                            class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a>
                    <a href="pages/excel2.php" target="_blank" type="button" class="btn btn-warning pull-right"><span
                            class="fa fa-download">
                        </span>
                        Download Data</a> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tmp Kos</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($santri as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nis'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['k_formal'] . ' - ' . $row['t_formal'] ?></td>
                                    <td><?= $tt[$row['t_kos']] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="nis" value="<?= $row['nis'] ?>">
                                            <input type="hidden" name="asal" value="<?= $row['t_kos'] ?>">
                                            <div class="form-group">
                                                <select name="t_kos" id="" class="form-control form-control-sm"
                                                    required>
                                                    <option value=""> -pilih tempat kos- </option>
                                                    <?php for ($i = 0; $i < count($tt); $i++) { ?>
                                                    <option value="<?= $i; ?>"><?= $tt[$i]; ?></option>
                                                    <?php }; ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="pindah" class="btn btn-success btn-sm"><i
                                                    class="fa fa-refresh"></i> Pindah
                                                Tempat</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

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

<?php

if (isset($_POST['pindah'])) {
    $t_kos = $_POST['t_kos'];
    $nis = $_POST['nis'];


    $sql = mysqli_query($conn, "UPDATE kosmen SET t_kos = $t_kos WHERE nis = $nis ");
    if ($sql) {
        echo "
        <script>
            alert('Data sudah dipindahkan');
            window.location = 'index.php?link=pages/dekos/rollDtl&id='" . $row['t_kos'] . "';
        </script>
        ";
    }
}

?>