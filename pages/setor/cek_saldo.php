
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Cek Saldo Dekosan
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <form action="" class="form-horizontal" method="post">
                        <!-- Date range -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pilih tahun : </label>
                            <!-- <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal" class="form-control pull-right" id="reservation"
                                        autocomplete="off" required>
                                </div>
                            </div> -->
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value=""> --pilih tahun-- </option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tahun ");
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
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" name="cari" class="btn btn-success"><span
                                        class="fa fa-search"></span>
                                    Tampilkan</button>
                            </div>
                        </div><!-- /.form group -->
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            //$tgl = $_POST['tanggal'];
            $tahun = $_POST['tahun'];

            $okt1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 10 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $okt2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 10 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $okt3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 10 AND tahun = '$tahun' "));

            $nov1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 11 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $nov2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 11 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $nov3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 11 AND tahun = '$tahun' "));

            $des1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 12 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $des2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 12 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $des3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 12 AND tahun = '$tahun' "));

            $sep1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 9 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $sep2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 9 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $sep3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 9 AND tahun = '$tahun' "));

            $jan1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 1 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $jan2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 1 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $jan3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 1 AND tahun = '$tahun' "));

            $feb1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 2 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $feb2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 2 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $feb3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 2 AND tahun = '$tahun' "));

            $mar1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 3 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $mar2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 3 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $mar3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 3 AND tahun = '$tahun' "));

            $apr1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 4 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $apr2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 4 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $apr3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 4 AND tahun = '$tahun' "));

            $mei1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 5 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $mei2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 5 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $mei3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 5 AND tahun = '$tahun' "));

            $jun1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 6 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $jun2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 6 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $jun3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 6 AND tahun = '$tahun' "));
            
            $jul1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 7 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $jul2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 7 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $jul3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 7 AND tahun = '$tahun' "));
            
            $agus1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 8 AND a.tahun = '$tahun' AND b.jkl = 'Laki-laki' "));
            $agus2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(a.nominal) AS jml FROM kos AS a JOIN tb_santri AS b ON a.nis=b.nis WHERE a.bulan = 8 AND a.tahun = '$tahun' AND b.jkl = 'Perempuan' "));
            $agus3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml, SUM(pa) AS pa, SUM(pi) AS pi  FROM setor WHERE bulan = 8 AND tahun = '$tahun' "));

        ?>
        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">
                            Data Tahun :
                            <p class="label label-info"><?= $tahun; ?></p>
                        </h3>
                        <a href="<?= 'pages/rekap/excel_kos.php?pa=' . $spa . '&pi=' . $spi . 'bulan=' . $bulan . '&tahun=' . $tahun  ?>"
                            target="_blank" type="button" class="btn btn-success pull-right"><span
                                class="fa fa-download">
                            </span>
                            Download excel</a>
                    </div>
                    <hr>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="background-color: black; color: white;">No.</th>
                                        <th rowspan="2" style="background-color: black; color: white;">Bulan</th>
                                        <th colspan="2" style="background-color: black; color: white;">Putra</th>
                                        <th colspan="2" style="background-color: black; color: white;">Putri</th>
                                        <th rowspan="2" style="background-color: black; color: white;">Total</th>
                                        <th rowspan="2" style="background-color: black; color: white;">Sudah Setor</th>
                                        <th rowspan="2" style="background-color: black; color: white;">Saldo</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: silver;">Jumlah</th>
                                        <th style="background: silver;">Saldo</th>
                                        <th style="background-color: silver;">Jumlah</th>
                                        <th style="background: silver;">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="font-weight: bold; color: #556B2F;">
                                    	<td>1</td>
                                    	<td>July</td>
                                    	<td><?= rupiah($jul1['jml']); ?> </td>
                                    	<td style="background: silver;"><?= rupiah($jul1['jml'] - $jul3['pa']); ?> </td>
                                    	<td><?= rupiah($jul2['jml']); ?> </td>
                                    	<td style="background: silver;"><?= rupiah($jul2['jml'] - $jul3['pi']); ?> </td>
                                    	<td><?= rupiah($jul1['jml'] + $jul2['jml']); ?> </td>
                                    	<td><?= rupiah($jul3['jml']); ?> </td>
                                    	<td><?= rupiah(($jul1['jml'] + $jul2['jml']) - $jul3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: #FF4500;">
                                    	<td>2</td>
                                    	<td>Agustus</td>
                                    	<td><?= rupiah($agus1['jml']); ?> </td>
                                    	<td style="background: silver;"><?= rupiah($agus1['jml'] - $agus3['pa']); ?> </td>
                                    	<td><?= rupiah($agus2['jml']); ?> </td>
                                    	<td style="background: silver;"><?= rupiah($agus2['jml'] - $agus3['pi']); ?> </td>
                                    	<td><?= rupiah($agus1['jml'] + $agus2['jml']); ?> </td>
                                    	<td><?= rupiah($agus3['jml']); ?> </td>
                                    	<td><?= rupiah(($agus1['jml'] + $agus2['jml']) - $agus3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: #800000;">
                                        <td>3</td>
                                        <td>September</td>
                                        <td><?= rupiah($sep1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($sep1['jml'] - $sep3['pa']); ?> </td>
                                        <td><?= rupiah($sep2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($sep2['jml'] - $sep3['pi']); ?> </td>
                                        <td><?= rupiah($sep1['jml'] + $sep2['jml']); ?> </td>
                                        <td><?= rupiah($sep3['jml']); ?> </td>
                                        <td><?= rupiah(($sep1['jml'] + $sep2['jml']) - $sep3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: green;">
                                        <td>4</td>
                                        <td>Oktober</td>
                                        <td><?= rupiah($okt1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($okt1['jml'] - $okt3['pa']); ?> </td>
                                        <td><?= rupiah($okt2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($okt2['jml'] - $okt3['pi']); ?> </td>
                                        <td><?= rupiah($okt1['jml'] + $okt2['jml']); ?> </td>
                                        <td><?= rupiah($okt3['jml']); ?> </td>
                                        <td><?= rupiah(($okt1['jml'] + $okt2['jml']) - $okt3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: goldenrod;">
                                        <td>5</td>
                                        <td>November</td>
                                        <td><?= rupiah($nov1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($nov1['jml'] - $nov3['pa']); ?> </td>
                                        <td><?= rupiah($nov2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($nov2['jml'] - $nov3['pi']); ?> </td>
                                        <td><?= rupiah($nov1['jml'] + $nov2['jml']); ?> </td>
                                        <td><?= rupiah($nov3['jml']); ?> </td>
                                        <td><?= rupiah(($nov1['jml'] + $nov2['jml']) - $nov3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: darkmagenta;">
                                        <td>6</td>
                                        <td>Desember</td>
                                        <td><?= rupiah($des1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($des1['jml'] - $des3['pa']); ?> </td>
                                        <td><?= rupiah($des2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($des2['jml'] - $des3['pi']); ?> </td>
                                        <td><?= rupiah($des1['jml'] + $des2['jml']); ?> </td>
                                        <td><?= rupiah($des3['jml']); ?> </td>
                                        <td><?= rupiah(($des1['jml'] + $des2['jml']) - $des3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: darkorange;">
                                        <td>7</td>
                                        <td>Januari</td>
                                        <td><?= rupiah($jan1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($jan1['jml'] - $jan3['pa']); ?> </td>
                                        <td><?= rupiah($jan2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($jan2['jml'] - $jan3['pi']); ?> </td>
                                        <td><?= rupiah($jan1['jml'] + $jan2['jml']); ?> </td>
                                        <td><?= rupiah($jan3['jml']); ?> </td>
                                        <td><?= rupiah(($jan1['jml'] + $jan2['jml']) - $jan3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: darkblue;">
                                        <td>8</td>
                                        <td>Februari</td>
                                        <td><?= rupiah($feb1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($feb1['jml'] - $feb3['pa']); ?> </td>
                                        <td><?= rupiah($feb2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($feb2['jml'] - $feb3['pi']); ?> </td>
                                        <td><?= rupiah($feb1['jml'] + $feb2['jml']); ?> </td>
                                        <td><?= rupiah($feb3['jml']); ?> </td>
                                        <td><?= rupiah(($feb1['jml'] + $feb2['jml']) - $feb3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: darkcyan;">
                                        <td>9</td>
                                        <td>Maret</td>
                                        <td><?= rupiah($mar1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($mar1['jml'] - $mar3['pa']); ?> </td>
                                        <td><?= rupiah($mar2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($mar2['jml'] - $mar3['pi']); ?> </td>
                                        <td><?= rupiah($mar1['jml'] + $mar2['jml']); ?> </td>
                                        <td><?= rupiah($mar3['jml']); ?> </td>
                                        <td><?= rupiah(($mar1['jml'] + $mar2['jml']) - $mar3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: darkslateblue;">
                                        <td>10</td>
                                        <td>April</td>
                                        <td><?= rupiah($apr1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($apr1['jml'] - $apr3['pa']); ?> </td>
                                        <td><?= rupiah($apr2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($apr2['jml'] - $apr3['pi']); ?> </td>
                                        <td><?= rupiah($apr1['jml'] + $apr2['jml']); ?> </td>
                                        <td><?= rupiah($apr3['jml']); ?> </td>
                                        <td><?= rupiah(($apr1['jml'] + $apr2['jml']) - $apr3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: crimson;">
                                        <td>11</td>
                                        <td>Mei</td>
                                        <td><?= rupiah($mei1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($mei1['jml'] - $mei3['pa']); ?> </td>
                                        <td><?= rupiah($mei2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($mei2['jml'] - $mei3['pi']); ?> </td>
                                        <td><?= rupiah($mei1['jml'] + $mei2['jml']); ?> </td>
                                        <td><?= rupiah($mei3['jml']); ?> </td>
                                        <td><?= rupiah(($mei1['jml'] + $mei2['jml']) - $mei3['jml']); ?> </td>
                                    </tr>
                                    <tr style="font-weight: bold; color: palevioletred;">
                                        <td>12</td>
                                        <td>Juni</td>
                                        <td><?= rupiah($jun1['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($jun1['jml'] - $jun3['pa']); ?> </td>
                                        <td><?= rupiah($jun2['jml']); ?> </td>
                                        <td style="background: silver;"><?= rupiah($jun2['jml'] - $jun3['pi']); ?> </td>
                                        <td><?= rupiah($jun1['jml'] + $jun2['jml']); ?> </td>
                                        <td><?= rupiah($jun3['jml']); ?> </td>
                                        <td><?= rupiah(($jun1['jml'] + $jun2['jml']) - $jun3['jml']); ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </form>
        <?php
        }
        ?>
    </div>
</section>