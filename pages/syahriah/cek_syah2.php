
<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Cek Data Pembayaran Syahriah (Perkelas)
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
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        <!-- Date range -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="kelas" id="" class="form-control" required>
                                    <option value=""> --pilih kelas-- </option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT * FROM kelas GROUP BY nama ");
                                    while ($thn = mysqli_fetch_array($th)) {
                                        $no++;
                                    ?>
                                        <option value="<?= $thn['nama'] ?>"><?= $thn['nama'] ?> <?= $thn['lembaga'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Jenjang</label>
                                <select name="tingkat" id="" class="form-control" required>
                                    <option value=""> --pilih jenjang-- </option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT lembaga FROM kelas GROUP BY lembaga ");
                                    while ($thn = mysqli_fetch_array($th)) {
                                        $no++;
                                    ?>
                                        <option value="<?= $thn['lembaga'] ?>"><?= $thn['lembaga'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tahun</label>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cari" class="btn btn-block btn-success"><span class="fa fa-search">
                                        Cek</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            //$jkl = $_POST['jkl'];
            $kelas = $_POST['kelas'];
            $tingkat = $_POST['tingkat'];
            $tahun = $_POST['tahun'];

            mysqli_query($conn, "DROP VIEW h1");
            mysqli_query($conn, "DROP VIEW h2");
            mysqli_query($conn, "DROP VIEW stts_byr_santri");
            mysqli_query($conn, "DROP VIEW hasil_bayar_santri");

            mysqli_query($conn, "CREATE VIEW h1 as (
                SELECT
                  tahapan.stts,
                  case when nama = 'Tahap 1' then nominal end as T1,    
                  case when nama = 'Tahap 2' then nominal end as T2,
                  case when nama = 'Tahap 3' then nominal end as T3,    
                  case when nama = 'Tahap 4' then nominal end as T4
                from tahapan WHERE tahun = '$tahun'
              )
              ");

            mysqli_query($conn, "CREATE VIEW h2 as (
                SELECT
                  stts,
                  sum(T1) as T1,
                  sum(T2) as T2,
                  sum(T3) as T3,
                  sum(T4) as T4
                from h1
                group by stts
              )");

            mysqli_query($conn, "CREATE VIEW stts_byr_santri AS (
                SELECT a.nis, a.nama, a.k_formal, a.t_formal, b.T1, b.T2, b.T3, b.T4, (b.T1+b.T2+b.T3+b.T4) AS total  FROM tb_santri AS a INNER JOIN h2 AS b 
                ON a.stts=b.stts WHERE a.k_formal = '$kelas' AND t_formal = '$tingkat' AND a.aktif= 'Y')
                ");

            mysqli_query($conn, "CREATE VIEW hasil_bayar_santri AS (
                    SELECT a.nis, a.nama, b.k_formal, b.t_formal, SUM(a.nominal) AS jml, a.tahun FROM syahriah AS a INNER JOIN tb_santri AS b 
                    ON a.nis=b.nis WHERE a.tahun = '$tahun' AND b.k_formal = '$kelas' AND b.t_formal = '$tingkat' AND b.aktif= 'Y'
                    GROUP BY nis)");

            $data = mysqli_query($conn, "SELECT a.nis, a.nama, a.k_formal, a.t_formal, 
            (SELECT IF(b.jml >= a.T1, a.T1, IF((b.jml < a.T1 && b.jml != 0), b.jml,0))) as Th1, a.T1,
            (SELECT IF(b.jml >= (a.T1 + a.T2), a.T2, IF((b.jml < (a.T1 + a.T2) && b.jml - (a.T1 + a.T2) >= 0), b.jml - (a.T1 + a.T2),0))) as Th2, a.T2,
            (SELECT IF(b.jml >= (a.T1 + a.T2 + a.T3), a.T3, IF((b.jml < (a.T1 + a.T2 + a.T3) && b.jml - (a.T1 + a.T2 + a.T3) >= 0), b.jml - (a.T1 + a.T2 + a.T3),0))) as Th3, a.T3,
            (SELECT IF(b.jml >= (a.T1 + a.T2 + a.T3 + a.T4), a.T4, IF((b.jml < (a.T1 + a.T2 + a.T3 + a.T4) && b.jml - (a.T1 + a.T2 + a.T3 + a.T4) >= 0), b.jml - (a.T1 + a.T2 + a.T3 + a.T4),0))) as Th4, a.T4, b.jml AS jml_bayar, a.total AS jml_t
            FROM stts_byr_santri AS a INNER JOIN hasil_bayar_santri AS b ON a.nis=b.nis ");

            $tidak = mysqli_query($conn, "SELECT * FROM stts_byr_santri WHERE NOT EXISTS (SELECT * FROM hasil_bayar_santri WHERE stts_byr_santri.nis = hasil_bayar_santri.nis) ");
            $j_tidak = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM stts_byr_santri WHERE NOT EXISTS (SELECT * FROM hasil_bayar_santri WHERE stts_byr_santri.nis = hasil_bayar_santri.nis) "));

        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                Data dari :
                                <br />
                                <br />
                                <p class="label label-primary"> KELAS : <?= $kelas; ?> <?= $tingkat; ?></p>
                                <p class="label label-danger"> TAHUN : <?= $tahun; ?></p>
                            </h3>
                            <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                                </span>
                                Download excel</a>
                        </div>
                        <hr>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tahap 1</th>
                                            <th>Tahap 2</th>
                                            <th>Tahap 3</th>
                                            <th>Tahap 4</th>
                                            <th>Jml Bayar</th>
                                            <th>Jml Tanggungan</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        <?php foreach ($data as $r) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r['nama']; ?></td>
                                                <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>

                                                <?php if ($r['Th1'] == $r['T1']) { ?>
                                                    <td style="font-weight: bold; color: green;"><?= rupiah($r['Th1']); ?> - (<span class="fa fa-check"></span>)</td>
                                                <?php } else { ?>
                                                    <td style="font-weight: bold; color: red;"><?= rupiah($r['Th1']); ?> - (<span class="fa fa-close"></span>)</td>
                                                <?php } ?>

                                                <?php if ($r['Th2'] == $r['T2']) { ?>
                                                    <td style="font-weight: bold; color: green;"><?= rupiah($r['Th2']); ?> - (<span class="fa fa-check"></span>)</td>
                                                <?php } else { ?>
                                                    <td style="font-weight: bold; color: red;"><?= rupiah($r['Th2']); ?> - (<span class="fa fa-close"></span>)</td>
                                                <?php } ?>

                                                <?php if ($r['Th3'] == $r['T3']) { ?>
                                                    <td style="font-weight: bold; color: green;"><?= rupiah($r['Th3']); ?> - (<span class="fa fa-check"></span>)</td>
                                                <?php } else { ?>
                                                    <td style="font-weight: bold; color: red;"><?= rupiah($r['Th3']); ?> - (<span class="fa fa-close"></span>)</td>
                                                <?php } ?>

                                                <?php if ($r['Th4'] == $r['T4']) { ?>
                                                    <td style="font-weight: bold; color: green;"><?= rupiah($r['Th4']); ?> - (<span class="fa fa-check"></span>)</td>
                                                <?php } else { ?>
                                                    <td style="font-weight: bold; color: red;"><?= rupiah($r['Th4']); ?> - (<span class="fa fa-close"></span>)</td>
                                                <?php } ?>


                                                <td><?= rupiah($r['jml_bayar']); ?></td>
                                                <td><?= rupiah($r['jml_t']); ?></td>
                                                <td><?= rupiah($r['jml_t'] - $r['jml_bayar']); ?></td>
                                                <!-- <td style="font-weight: bold; color: green;"><span class="fa fa-check"></span>
                                            Lunas
                                        </td> -->
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                        <br>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tahap 1</th>
                                            <th>Tahap 2</th>
                                            <th>Tahap 3</th>
                                            <th>Tahap 4</th>
                                            <th>Jml Bayar</th>
                                            <th>Jml Tanggungan</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        <?php foreach ($tidak as $r) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r['nama']; ?></td>
                                                <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                                <td colspan="5" style="font-weight: bold; color: red; text-align: center;">
                                                    (<span class="fa fa-close"></span>) - TIDAK BAYAR SAMA SEKALI</td>
                                                <td><?= rupiah($r['total']); ?></td>
                                                <td>-</td>
                                                <!-- <td style="font-weight: bold; color: green;"><span class="fa fa-check"></span>
                                            Lunas
                                        </td> -->
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
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