<?php
require 'function.php';
if (isset($_POST["simpan"])) {
    if (add_keluar($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/pengeluaran/keluar';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/pengeluaran/keluar';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Input Data pengeluaran
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
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama Item</label>
                            <div class="col-sm-10">
                                <select name="item" id="" class="form-control" required>
                                    <option value="">---------------</option>
                                    <?php
                                    $data = mysqli_query($conn, "SELECT * FROM item");
                                    $no = 0;
                                    while ($r = mysqli_fetch_array($data)) {
                                        $no++;
                                    ?>
                                        <option value="<?= $r['id_item'] ?>"><?= $r['kode_i'].' - '.$r['nama_i'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Uraian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" placeholder="Uraian Pengeluaran">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penjab</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="pemohon" placeholder="Nama Penjab">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal" placeholder="Nominal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile" class="col-sm-2 control-label">Bukti Nota</label>
                            <div class="col-sm-10">
                                <input type="file" id="exampleInputFile" name="gambar" id="gambar">
                                <p class="help-block">(file jpg/png Max. 2 MB)</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tgl" id="datepic" placeholder="Tanggal" autocomplete="off">
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
                        <button type="submit" name="simpan" class="btn btn-danger pull-right"><span class="fa fa-check"></span> Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->