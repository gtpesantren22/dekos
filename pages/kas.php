<?php
require 'function.php';
$M = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(masuk) AS tm FROM kas WHERE ket = 'M' "));
$K = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(keluar) AS tk FROM kas WHERE ket = 'K' "));
$kas = $M['tm'] - $K['tk'];
$bl = array("", "Januari", "Januari", "Februari", "Maret", "April", "Mei", "Juny", "July", "September", "Oktober", "November", "Desember")
?>
<section class="content-header">
    <h1><span class="fa fa-book"> </span>
        Buku Kas
        <small>advanced tables</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="info-box bg-blue">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Pemasukan - Jumlah Pengeluaran</span>
                    <span class="info-box-number"><?= rupiah($M['tm']); ?> - <?= rupiah($K['tk']); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        <span class="info-box-number">Saldo : <?= rupiah($kas); ?></span>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
            <form action="" method="post" id="">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pilih Tahun</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        $jmlt = mysqli_query($conn, "SELECT YEAR(tgl) AS th FROM kas GROUP BY th");
                        foreach ($jmlt as $jt) :
                            $th = $jt['th']; ?>
                            <input type="radio" name="thn" id="" value="<?= $th ?>"> Th. <?= $jt['th'] ?>
                        <?php endforeach; ?>
                        <button type="submit" name="view" class="btn btn-info pull-right">Tampilkan</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['view'])) {
                # code...
                //$bl = array("", "Januari", "Januari", "Februari", "Maret", "April", "Mei", "Juny", "July", "September", "Oktober", "November", "Desember");
                $th = $_POST['thn']; ?>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <?php $jmlb = mysqli_query($conn, "SELECT MONTH(tgl) AS bl FROM kas WHERE YEAR(tgl) = $th GROUP BY bl");
                        foreach ($jmlb as $dd) : ?>
                            <li class=""><a href="#<?= $bl[$dd['bl']] ?>" data-toggle="tab"><?= $bl[$dd['bl']] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($jmlb as $dd) :
                            $b = $dd['bl'] ?>
                            <div class=" tab-pane" id="<?= $bl[$dd['bl']] ?>">
                                <?php
                                $masuk =  mysqli_query($conn, "SELECT tgl, nama, masuk, keluar, ket, nama_i, kode_i FROM kas a JOIN item b ON a.item=b.id_item WHERE MONTH(tgl) = $b AND YEAR(tgl) = $th ORDER BY keluar,kode_i,tgl ASC");
                                $item =  mysqli_query($conn, "SELECT SUM(masuk) as masuk, SUM(keluar) as keluar, nama_i, kode_i FROM kas a JOIN item b ON a.item=b.id_item WHERE MONTH(tgl) = $b AND YEAR(tgl) = $th GROUP BY kode_i ORDER BY ket DESC");
                                $M =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT tgl, SUM(masuk) as jm, SUM(keluar) as jk FROM kas WHERE MONTH(tgl) = $b AND YEAR(tgl) = $th "));
                                ?>
                                <!-- <h4><?= $th ?></h4> -->
                                <!-- <button class="btn btn-danger pull-right"><i class="fa fa-print"></i> Print Laporan</button> -->

                                <!-- //Data Peritem -->
                                <strong>
                                    <center>Data Peritem</center>
                                </strong>
                                <a href="<?= 'pages/coba.php?bl=' . $b . '&thn=' . $th ?>" target="_blank">
                                    <button class="btn btn-success "><i class="fa fa-file-excel-o"></i> Download Excel</button>
                                </a>
                                <br><br>
                                <table id="example<?= $dd['bl'] ?>" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Kode</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;

                                        foreach ($item as $r) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r["nama_i"]; ?> </td>
                                                <td><?= $r["kode_i"]; ?> </td>
                                                <?php if ($i == 1) {
                                                    $debit = $r['masuk'];
                                                    $saldo =  $r['masuk']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } elseif ($r['masuk'] != 0) {
                                                    $saldo = $saldo + $r['masuk']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } else {
                                                    $saldo = $saldo - $r['keluar']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } ?>
                                            <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">
                                                Total :
                                            </th>
                                            <th style="background-color: #00A65A; color: white"><?= rupiah($M['jm']); ?></th>
                                            <th style="background-color: #DD4B39; color: white"><?= rupiah($M['jk']); ?></th>
                                            <th style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
                                        </tr>

                                        <!-- <tr>
                                            <th colspan="3" class="text-right">
                                                Saldo Akhir :
                                            </th>
                                            <th colspan="3" style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
                                        </tr> -->
                                    </tfoot>
                                </table>

                                <hr>

                                <strong>
                                    <center> Rincian Data</center>
                                </strong>
                                <br><br>
                                <table id="example<?= $dd['bl'] ?>" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Uraian</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;

                                        foreach ($masuk as $r) :
                                        ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r["nama_i"]; ?> </td>
                                                <td><?= $r["kode_i"]; ?> </td>
                                                <td><?= date("d-M-Y", strtotime($r["tgl"])); ?> </td>
                                                <td><?= $r["nama"]; ?></td>

                                                <?php if ($i == 1) {
                                                    $debit = $r['masuk'];
                                                    $saldo =  $r['masuk']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } elseif ($r['masuk'] != 0) {
                                                    $saldo = $saldo + $r['masuk']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } else {
                                                    $saldo = $saldo - $r['keluar']; ?>
                                                    <td><?= rupiah($r['masuk']) ?></td>
                                                    <td><?= rupiah($r['keluar']) ?></td>
                                                    <td><?= rupiah($saldo) ?></td>
                                                <?php } ?>
                                            <?php $i++;
                                        endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-right">
                                                Total :
                                            </th>
                                            <th style="background-color: #00A65A; color: white"><?= rupiah($M['jm']); ?></th>
                                            <th style="background-color: #DD4B39; color: white"><?= rupiah($M['jk']); ?></th>
                                            <th style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
                                        </tr>

                                        <!-- <tr>
                                            <th colspan="3" class="text-right">
                                                Saldo Akhir :
                                            </th>
                                            <th colspan="3" style="background-color: #605CA8; color: white"><?= rupiah($M['jm'] - $M['jk']); ?></th>
                                        </tr> -->
                                    </tfoot>
                                </table>
                            </div><!-- /.tab-pane -->
                        <?php endforeach; ?>
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            <?php } ?>
        </div><!-- /.col -->
    </div>
</section><!-- /.content -->
<?php $jmlb = mysqli_query($conn, "SELECT MONTH(tgl) AS bl FROM kas WHERE YEAR(tgl) = $th GROUP BY bl");
foreach ($jmlb as $dd) : ?>
    <script>
        $(function() {
            $("#example<?= $dd['bl'] ?>").DataTable();
        });
    </script>
<?php endforeach; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#yes').submit(function(e) {
            e.preventDefault();
            var tahun = $('#thn').val();
            // console.log(id_santri);
            var url = "pages/v_kas.php?thn=" + tahun
            $('#result').load(url);
        })
    });
</script>