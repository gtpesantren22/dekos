<?php

if (isset($_POST["simpan"])) {
    if (syahriah($_POST) > 0) {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/syah';
        </script>  
";
    } else {
        echo "
        <script>
            window.location.href = 'index.php?link=pages/syah';
        </script>   
";
    }
}

$tahap1 = query("SELECT * FROM tahapan WHERE nama = 'Tahap 1' ORDER BY id ASC ");
$tahap2 = query("SELECT * FROM tahapan WHERE nama = 'Tahap 2' ORDER BY id ASC ");
$tahap3 = query("SELECT * FROM tahapan WHERE nama = 'Tahap 3' ORDER BY id ASC ");
$tahap4 = query("SELECT * FROM tahapan WHERE nama = 'Tahap 4' ORDER BY id ASC ");

?>
<section class="content-header">
    <h1>
        Input Data Pembayaran Syahriyah
        <small>(baru)</small>
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

        <!-- =========================================================================================== -->
        <!-- TAHAP 1 -->
        <div class="col-md-4">
            <div class="box box-solid box-success">
                <?php

                ?>
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Tahap 1 (Jul - Sept) | Th. 2020/2021</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($tahap1 as $r) : ?>
                            <tr>
                                <th><?php $st = $r["stts"];
                                        $ps = explode("-", $st);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>P. Wil</span>";
                                            echo " ";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                <th><?= rupiah($r["nominal"]); ?> </th>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col (right) -->

        <!-- =========================================================================================== -->
        <!-- TAHAP 1 -->
        <div class="col-md-4">
            <div class="box box-solid box-success">
                <?php

                ?>
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Tahap 2 (Okt - Des) | Th. 2020/2021</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($tahap2 as $r) : ?>
                            <tr>
                                <th><?php $st = $r["stts"];
                                        $ps = explode("-", $st);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>P. Wil</span>";
                                            echo " ";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                <th><?= rupiah($r["nominal"]); ?> </th>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <!-- =========================================================================================== -->
        <!-- TAHAP 3 -->
        <div class="col-md-4">
            <div class="box box-solid box-success">
                <?php

                ?>
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Tahap 3 (Jan - Mar) | Th. 2020/2021</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($tahap3 as $r) : ?>
                            <tr>
                                <th><?php $st = $r["stts"];
                                        $ps = explode("-", $st);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>P. Wil</span>";
                                            echo " ";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                <th><?= rupiah($r["nominal"]); ?> </th>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!-- =========================================================================================== -->
        <!-- TAHAP 4 -->
        <div class="col-md-4">
            <div class="box box-solid box-success">
                <?php

                ?>
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Tahap 1 (Apr - Jun) | Th. 2020/2021</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($tahap4 as $r) : ?>
                            <tr>
                                <th><?php $st = $r["stts"];
                                        $ps = explode("-", $st);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>P. Wil</span>";
                                            echo " ";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                <th><?= rupiah($r["nominal"]); ?> </th>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <!-- =========================================================================================== -->
        <!-- TAHAP 1 -->
        <div class="col-md-8">
            <div class="box box-solid box-danger">
                <?php

                ?>
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Jumlah Pembayaran Selama 1 tahun | Th. 2020/2021</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($tahap1 as $r) : ?>
                            <tr>
                                <th><?= $i; ?></th>
                                <th><?php $st = $r["stts"];
                                        $ps = explode("-", $st);
                                        if ($ps[0] == 1) {
                                            echo "<span class='label label-default'>Ust/Usdz</span>";
                                            echo " ";
                                        }
                                        if ($ps[1] == 2) {
                                            echo "<span class='label label-primary'>Mhs/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[2] == 3) {
                                            echo "<span class='label label-success'>Sdr/i</span>";
                                            echo " ";
                                        }
                                        if ($ps[3] == 4) {
                                            echo "<span class='label label-info'>Kls 6</span>";
                                            echo " ";
                                        }
                                        if ($ps[4] == 5) {
                                            echo "<span class='label label-warning'>Baru</span>";
                                            echo " ";
                                        }
                                        if ($ps[5] == 6) {
                                            echo "<span class='label label-danger'>Lama</span>";
                                            echo " ";
                                        }
                                        if ($ps[6] == 7) {
                                            echo "<span class='label label-primary'>P. Wil</span>";
                                            echo " ";
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></th>
                                <th><?= rupiah($r["nominal"]); ?> </th>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div> <!-- /.row -->
</section><!-- /.content -->