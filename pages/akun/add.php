<?php
require 'function.php';
if (isset($_POST["simpan"])) {
    if (add_akun($_POST) > 0) {
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
        Input Item Baru
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
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="id" placeholder="" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Kode Item</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="kode" placeholder="Kode Item Baru">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama Item</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" placeholder="Nama Item Baru">
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