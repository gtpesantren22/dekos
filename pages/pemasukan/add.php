<?php
require 'function.php';
if (isset($_POST["simpan"])) {
    if (add_masuk($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/pemasukan/masuk';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/pemasukan/masuk';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Input Data Pemasukan
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
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama Item</label>
                            <div class="col-sm-10">
                                <select name="item" id="" class="form-control" required>
                                    <option value=""> -- pilih item -- </option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM item");
                                    while ($dt = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $dt['id_item'] ?>"><?= $dt['kode_i'] ?> - <?= $dt['nama_i'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Uraian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" placeholder="Nama Pemasukan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal" placeholder="Nominal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Terima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="datepic" name="tgl" required autocomplete="off" placeholder="Tanggal Terima">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" value="<?= $_SESSION['nama'] ?>" disabled>
                                <input type="hidden" name="penerima" value="<?= $_SESSION['nama'] ?>">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="simpan" class="btn btn-success pull-right"><span class="fa fa-check"></span>Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->