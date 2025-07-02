<?php

//$id = $_GET["id"];
$id = $_GET["id"];
$r = query("SELECT * FROM kos WHERE id = $id ")[0];

$nis = $r['nis'];
$r2 = query("SELECT * FROM tb_santri WHERE nis = $nis")[0];
if (isset($_POST["edit"])) {
    if (edit_dekos($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/dekos/dekos';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/dekos/dekos';
        </script>   
";
    }
}
?>
<section class="content-header">
    <h1>
        Edit Data Dekosan
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
                        <input type="hidden" name="nis" value="<?= $nis; ?>">
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">NIS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nis" value="<?= $r['nis'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" name="nama" value="<?= $r2['nama'] ?>" disabled>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="" class="col-sm-2 control-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rupiah" name="nominal" value="<?= rupiah($r['nominal']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Untuk Bulan</label>
                            <div class="col-sm-5">
                                <select name="bln" id="" class="form-control" required>
                                    <option value="">-- Pilih Bulan --</option>
                                    <option <?= $r['bulan'] == 1 ? 'selected' : '' ?> value="1">Januari</option>
                                    <option <?= $r['bulan'] == 2 ? 'selected' : '' ?> value="2">Februari</option>
                                    <option <?= $r['bulan'] == 3 ? 'selected' : '' ?> value="3">Maret</option>
                                    <option <?= $r['bulan'] == 4 ? 'selected' : '' ?> value="4">April</option>
                                    <option <?= $r['bulan'] == 5 ? 'selected' : '' ?> value="5">Mei</option>
                                    <option <?= $r['bulan'] == 6 ? 'selected' : '' ?> value="6">Juni</option>
                                    <option <?= $r['bulan'] == 7 ? 'selected' : '' ?> value="7">Juli</option>
                                    <option <?= $r['bulan'] == 8 ? 'selected' : '' ?> value="8">Agustus</option>
                                    <option <?= $r['bulan'] == 9 ? 'selected' : '' ?> value="9">September</option>
                                    <option <?= $r['bulan'] == 10 ? 'selected' : '' ?> value="10">Oktober</option>
                                    <option <?= $r['bulan'] == 11 ? 'selected' : '' ?> value="11">November</option>
                                    <option <?= $r['bulan'] == 12 ? 'selected' : '' ?> value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select name="thn" id="" class="form-control" required>
                                    <option value="">-- Pilih Tahun --</option>

                                    <?php
                                    $th = mysqli_query($conn, "SELECT * FROM tahun ORDER BY id DESC");
                                    $nis = 0;
                                    while ($thn = mysqli_fetch_array($th)) {
                                        $nis++;
                                    ?>
                                        <option <?= $r['tahun'] == $thn['nama'] ? 'selected' : '' ?> value="<?= $thn['nama'] ?>" cele><?= $thn['nama'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Tanggal Bayar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tgl" id="datepic" value="<?= $r['tgl'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputtext3" class="col-sm-2 control-label">Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputtext3" value="<?= $r['penerima'] ?>" disabled>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="edit" class="btn btn-success pull-right"><span class="fa fa-check"></span> Simpan</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div> <!-- /.row -->
</section><!-- /.content -->