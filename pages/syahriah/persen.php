
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Porsentase pembayaran santri
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
                <div class="box-body">
                    <form action="" method="post">
                        <!-- Date range -->
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Pilih Tahun Ajaran</label>
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cari" class="btn btn-block btn-success"><span class="fa fa-search">
                                        Tampilkan </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $tahun = $_POST['tahun'];
            $usd_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Laki-laki' AND stts LIKE '1-%' "));
            $usd_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Perempuan' AND stts LIKE '1-%' "));
            $pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Laki-laki' "));
            $pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE aktif = 'Y' AND jkl = 'Perempuan' "));

            $mts_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif='Y' AND t_formal = 'MTs' AND stts NOT LIKE '1-%' "));
            $mts_pa_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Laki-laki' AND t.t_formal = 'MTs' AND s.tahun = '$tahun' GROUP BY t.nis "));
            $mts_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Perempuan' AND aktif='Y' AND t_formal = 'MTs' AND stts NOT LIKE '1-%'"));
            $mts_pi_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Perempuan' AND t.t_formal = 'MTs' AND s.tahun = '$tahun' GROUP BY t.nis "));

            $smp_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif='Y' AND t_formal = 'smp' AND stts NOT LIKE '1-%'"));
            $smp_pa_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Laki-laki' AND t.t_formal = 'smp' AND s.tahun = '$tahun' GROUP BY t.nis "));
            $smp_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Perempuan' AND aktif='Y' AND t_formal = 'smp' AND stts NOT LIKE '1-%'"));
            $smp_pi_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Perempuan' AND t.t_formal = 'smp' AND s.tahun = '$tahun' GROUP BY t.nis "));

            $ma_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif='Y' AND t_formal = 'ma' AND stts NOT LIKE '1-%'"));
            $ma_pa_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Laki-laki' AND t.t_formal = 'ma' AND s.tahun = '$tahun' GROUP BY t.nis "));
            $ma_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Perempuan' AND aktif='Y' AND t_formal = 'ma' AND stts NOT LIKE '1-%'"));
            $ma_pi_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Perempuan' AND t.t_formal = 'ma' AND s.tahun = '$tahun' GROUP BY t.nis "));

            $smk_pa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Laki-laki' AND aktif='Y' AND t_formal = 'smk' AND stts NOT LIKE '1-%'"));
            $smk_pa_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Laki-laki' AND t.t_formal = 'smk' AND s.tahun = '$tahun' GROUP BY t.nis "));
            $smk_pi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE jkl = 'Perempuan' AND aktif='Y' AND t_formal = 'smk' AND stts NOT LIKE '1-%'"));
            $smk_pi_byr = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM syahriah s JOIN tb_santri t ON t.nis=s.nis WHERE t.jkl = 'Perempuan' AND t.t_formal = 'smk' AND s.tahun = '$tahun' GROUP BY t.nis "));
        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <center>
                                <h3 class="box-title">
                                    Jumlah Santri
                                </h3>
                            </center>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="alert alert-warning ">
                                        <table>
                                            <tr>
                                                <td>
                                                    <h4>JUMLAH ASATID</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $usd_pa ?></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>JUMLAH USTADZAH</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $usd_pi ?></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>TOTAL (GRATIS)</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $usd_pa + $usd_pi ?></h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-success ">
                                        <table>
                                            <tr>
                                                <td>
                                                    <h4>JUMLAH SANTRI PUTRA</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $pa - $usd_pa ?></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>JUMLAH SANTRI PUTRI</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $pi - $usd_pi ?></h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>TOTAL (BAYAR)</h4>
                                                </td>
                                                <td>
                                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= ($pa - $usd_pa) + ($pi - $usd_pi) ?></h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="alert alert-info ">
                                        <center>
                                            <h4>TOTAL SANTRI</h4>
                                            <h1><?= $pa + $pi ?> santri</h1>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="box box-success">
                                    <div class="box-header">
                                        <center>
                                            <h3 class="box-title">
                                                Pembayaran Santri
                                            </h3>
                                        </center>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3">
                                                                    <center>SANTRI PUTRA</center>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Lembaga</th>
                                                                <th>Sudah</th>
                                                                <th>Belum</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>MTs</td>
                                                                <td><?= $mts_pa_byr ?></td>
                                                                <td><?= $mts_pa - $mts_pa_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SMP</td>
                                                                <td><?= $smp_pa_byr ?></td>
                                                                <td><?= $smp_pa - $smp_pa_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MA</td>
                                                                <td><?= $ma_pa_byr ?></td>
                                                                <td><?= $ma_pa - $ma_pa_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SMK</td>
                                                                <td><?= $smk_pa_byr ?></td>
                                                                <td><?= $smk_pa - $smk_pa_byr ?></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>TOTAL</th>
                                                                <th><?= $mts_pa_byr + $smp_pa_byr + $ma_pa_byr + $smk_pa_byr ?></th>
                                                                <th><?= ($mts_pa - $mts_pa_byr) + ($smp_pa - $smp_pa_byr) + ($ma_pa - $ma_pa_byr) + ($smk_pa - $smk_pa_byr) ?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3">
                                                                    <center>SANTRI PUTRI</center>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Lembaga</th>
                                                                <th>Sudah</th>
                                                                <th>Belum</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>MTs</td>
                                                                <td><?= $mts_pi_byr ?></td>
                                                                <td><?= $mts_pi - $mts_pi_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SMP</td>
                                                                <td><?= $smp_pi_byr ?></td>
                                                                <td><?= $smp_pi - $smp_pi_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MA</td>
                                                                <td><?= $ma_pi_byr ?></td>
                                                                <td><?= $ma_pi - $ma_pi_byr ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SMK</td>
                                                                <td><?= $smk_pi_byr ?></td>
                                                                <td><?= $smk_pi - $smk_pi_byr ?></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>TOTAL</th>
                                                                <th><?= $mts_pi_byr + $smp_pi_byr + $ma_pi_byr + $smk_pi_byr ?></th>
                                                                <th><?= ($mts_pi - $mts_pi_byr) + ($smp_pi - $smp_pi_byr) + ($ma_pi - $ma_pi_byr) + ($smk_pi - $smk_pi_byr) ?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box box-success">
                                    <div class="box-header">
                                        <center>
                                            <h3>
                                                Santri Sudah Bayar :
                                                <?= ($mts_pa_byr + $smp_pa_byr + $ma_pa_byr + $smk_pa_byr) + ($mts_pi_byr + $smp_pi_byr + $ma_pi_byr + $smk_pi_byr) ?> santri</h3>
                                            <h1><?= round((($mts_pa_byr + $smp_pa_byr + $ma_pa_byr + $smk_pa_byr) + ($mts_pi_byr + $smp_pi_byr + $ma_pi_byr + $smk_pi_byr)) / 1208 * 100,0) ?> %</h1>
                                        </center>
                                    </div>
                                    <div class="box-body">

                                    </div>
                                    <div class="box-header">
                                        <center>
                                            <h3>
                                                Santri Belum Bayar :
                                                <?= (($mts_pa - $mts_pa_byr) + ($smp_pa - $smp_pa_byr) + ($ma_pa - $ma_pa_byr) + ($smk_pa - $smk_pa_byr)) +
                                                    (($mts_pi - $mts_pi_byr) + ($smp_pi - $smp_pi_byr) + ($ma_pi - $ma_pi_byr) + ($smk_pi - $smk_pi_byr)) ?> santri</h3>
                                            <h1><?= round(((($mts_pa - $mts_pa_byr) + ($smp_pa - $smp_pa_byr) + ($ma_pa - $ma_pa_byr) + ($smk_pa - $smk_pa_byr)) +
                                                    (($mts_pi - $mts_pi_byr) + ($smp_pi - $smp_pi_byr) + ($ma_pi - $ma_pi_byr) + ($smk_pi - $smk_pi_byr))) / 1208 * 100,0) ?> %</h1>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php
        }
        ?>
    </div>
</section>