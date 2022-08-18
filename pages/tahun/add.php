<?php
require 'function.php';
if (isset($_POST["simpan"])) {
    if (add_tahun($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/tahun/tahun';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/tahun/tahun';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Input Data Tahun Ajaran
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="id" placeholder=""
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Tahun Ajaran</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama"
                                    placeholder="Tahun Ajaran">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="simpan" class="btn btn-primary pull-right"><span
                                class="fa fa-check"></span> Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->