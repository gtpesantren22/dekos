<?php
require 'function.php';
$id = $_GET["id"];
$r = query("SELECT * FROM item WHERE id_item = $id ")[0];
if (isset($_POST["simpan"])) {
    if (edit_akun($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/akun/akun';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/akun/akun';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Edit Data Item
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Edit Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="hidden" name="id" id="" value="<?= $id; ?>">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id" value="<?= $id; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Kode Item</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="kode" value="<?= $r['kode_i'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama Item</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" value="<?= $r['nama_i'] ?>">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="simpan" class="btn btn-warning pull-right"><span class="fa fa-check"></span> Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->