<?php
require 'function.php';
$santri =  query("SELECT * FROM tempat ORDER by kd_tmp ASC");
?>
<section class="content-header">
    <h1>
        Data Tempat Dekosan
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
                    <h3 class="box-title">Data tempat dekos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Tempat</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no =  1;
                                        foreach ($santri as $ar) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $ar['kd_tmp']; ?></td>
                                                <td><?= $ar['nama']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_tempat" value="<?= $ar['id_tempat']; ?>">
                                                        <button class="btn btn-danger btn-xs" type="submit" name="dell">Del</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">Kode Dekosan</label>
                                    <input type="number" class="form-control" name="kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pemilik Dekosan</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat Untuk</label>
                                    <select class="form-control" name="jkl" required>
                                        <option value=""> -pilih- </option>
                                        <option value="Putra">Putra</option>
                                        <option value="Putri">Putri</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-success" type="submit" name="save"><i class="fa fa-check"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
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

<?php

if (isset($_POST['save'])) {
    $kode = $_POST['kode'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $jkl = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['jkl']));

    $ssql = mysqli_query($conn, "INSERT INTO tempat VALUES ('', '$kode', '$nama', '$jkl') ");
    if ($ssql) {
        echo "
        <script>
            window.location = 'index.php?link=pages/tempat';
        </script>
        ";
    }
}

if (isset($_POST['dell'])) {
    $id_tempat = $_POST['id_tempat'];

    $ssql = mysqli_query($conn, "DELETE FROM tempat WHERE id_tempat = '$id_tempat' ");
    if ($ssql) {
        echo "
        <script>
            window.location = 'index.php?link=pages/tempat';
        </script>
        ";
    }
}

?>