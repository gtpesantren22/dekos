<?php

//$id = $_GET["id"];
$id = $_GET["id"];
$r = query("SELECT * FROM setor WHERE id = $id ")[0];

if (isset($_POST["edit"])) {
    if (edit_setor($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/setor/setor';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/setor/setor';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Edit Data Setoran
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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Edit Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post">
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Uraian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" value="<?= $r['nama'] ?>">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ket" value="<?= $r['sampai']; ?> ">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal" value="<?= rupiah($r['nominal']); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Setor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tgl" id="datepic" value="<?= $r['tgl'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penyetor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="penyetor" value="<?= $r['penyetor'] ?>" required>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="edit" class="btn btn-success pull-right"><span class="fa fa-check"></span>
                            Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->