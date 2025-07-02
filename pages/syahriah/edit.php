<?php

$id = $_GET["id"];
$r = query("SELECT * FROM syahriah WHERE id = $id ")[0];
if (isset($_POST["simpan"])) {
    if (edit_syahriah($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/syahriah/syah';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/syahriah/syah';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Edit Data Syahriah
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
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Edit Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post">
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">NIS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nis"
                                    value="<?= $r['nis'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama"
                                    value="<?= $r['nama'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Tanggal Bayar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="datepic" name="tgl"
                                    value="<?= $r['tgl'] ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal"
                                    value="<?= rupiah($r['nominal']) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Tahun Ajaran</label>
                            <div class="col-sm-10">
                                <select name="tahun" id="" class="form-control">
                                    <option value="<?= $r['tahun'] ?>" selected><?= $r['tahun'] ?></option>
                                    <option value="">-------------</option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT * FROM tahun");
                                    $no = 0;
                                    while ($thn = mysqli_fetch_array($th)) {
                                        $no++;
                                    ?>
                                    <option value="<?= $thn['nama'] ?>"><?= $thn['nama'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="penerima" id="inputtext3"
                                    value="<?= $r['kasir'] ?>" disabled>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="simpan" class="btn btn-danger pull-right"><span
                                class="fa fa-check"></span> Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->