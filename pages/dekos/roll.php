<?php
require 'function.php';
$santri =  query("SELECT t_kos, COUNT(t_kos) AS jml FROM tb_santri WHERE aktif = 'Y' GROUP BY t_kos HAVING jml > 1 ");
$smnt =  query("SELECT t_kos, COUNT(t_kos) AS jml FROM kosmen GROUP BY t_kos HAVING jml > 1 ");
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
                                    <th>Nama Tempat</th>
                                    <th>Jumlah</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($santri as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $tt[$row['t_kos']] ?></td>
                                    <td><?= $row['jml'] ?></td>
                                    <td>
                                        <form action="" method="post">
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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hasil Rolling Sementara Data Dekosan</h3>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tempat</th>
                                        <th>Jumlah</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($smnt as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $tt[$row['t_kos']] ?></td>
                                        <td><?= $row['jml'] ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="asal" value="<?= $row['t_kos'] ?>">
                                                <a href="index.php?link=pages/dekos/rollDtl&id=<?= $row['t_kos'] ?>"
                                                    class="btn btn-success btn-xs"><i class="fa fa-users"></i>
                                                    Lihat Detail Santri</a>
                                                <a href="index.php?link=pages/dekos/hapus&kd=tks&id=<?= $row['t_kos'] ?>"
                                                    onclick="return confirm('Yakin akan dihapus ?')"
                                                    class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                    Hapus</a>
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

<?php

if (isset($_POST['pindah'])) {
    $t_kos = $_POST['t_kos'];
    $asal = $_POST['asal'];
    $bulan = date('m');
    $tahun = date('Y');

    $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kosmen WHERE t_kos = $t_kos "));
    if ($cek > 0) {
        echo "
        <script>
            alert('Maaf data ini sudah ditempati');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO kosmen (nis, t_kos, bulan, tahun) SELECT nis, $t_kos, $bulan, $tahun FROM tb_santri WHERE t_kos = $asal AND aktif = 'Y' ");
        if ($sql) {
            echo "
        <script>
            alert('Data sudah dipindahkan');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
        }
    }
}

?>