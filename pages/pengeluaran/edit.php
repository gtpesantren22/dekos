<?php
require 'function.php';
//$id = $_GET["id"];
$kode = $_GET["kode"];
$r = query("SELECT * FROM keluar WHERE kode = '$kode' ")[0];
if (isset($_POST["simpan"])) {
    if (edit_keluar($_POST) > 0) {
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
                        <input type="hidden" name="gambarLama" value="<?= $r["foto"]; ?>">
                        <!-- <input type="hidden" name="id" value="<?= $r["id"]; ?>"> -->
                        <input type="hidden" name="kode" value="<?= $r["kode"]; ?>">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama Item</label>
                            <div class="col-sm-10">
                                <select name="item" id="" class="form-control" required>
                                    <option value=""> -- pilih item -- </option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM item");
                                    while ($dt = mysqli_fetch_assoc($sql)) {
                                        if ($dt['id_item'] == $r['item']) {
                                            $sc = 'selected';
                                        } else {
                                            $sc = '';
                                        }
                                    ?>
                                        <option <?= $sc ?> value="<?= $dt['id_item'] ?>"><?= $dt['kode_i'] . ' - ' . $dt['nama_i'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Uraian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" value="<?= $r['nama'] ?>"="Uraian Pengeluaran">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">No. Nota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="no_nota" disabled value="<?= $r['no_nota'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="pemohon" value="<?= $r['pemohon'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal" value="<?= rupiah($r['nominal']) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile" class="col-sm-2 control-label">Bukti Nota</label>
                            <div class="col-sm-10">
                                <input type="file" id="exampleInputFile" name="gambar" id="gambar"><br>
                                <img src="img/<?= $r["foto"]; ?>" width="80" alt="" style="border: 1px solid black;"><br>
                                <p class="help-block">(file jpg/png Max. 2 MB)</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Terima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" value="<?= $r['tgl'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="penerima" id="inputtext3" value="<?= $r['kasir'] ?>" disabled>
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