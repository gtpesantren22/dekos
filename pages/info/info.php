<?php
require 'function.php';
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Cek Data Dekosan (Perkelas)
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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="kelas" id="" class="form-control" required>
                                    <option value=""> --pilih kelas-- </option>
                                    <?php
                                    $dt = mysqli_query($conn, "SELECT * FROM kelas ORDER BY lembaga");
                                    while ($r = mysqli_fetch_assoc($dt)) {
                                    ?>
                                        <option value="<?= $r['nama'] . '/' . $r['lembaga'] ?>"><?= $r['nama'] ?> <?= $r['lembaga'] ?></option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="form-control" required>
                                    <option value=""> --pilih bulan-- </option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
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
                        <div class="col-md-2">
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

            $kls = explode('/', $_POST['kelas']);
            $kelas = $kls[0];
            $tingkat = $kls[1];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];

            mysqli_query($conn, "DROP VIEW IF EXISTS rekap");
            mysqli_query($conn, "DROP VIEW IF EXISTS rekap2");
            mysqli_query($conn, "TRUNCATE TABLE kirim");

            mysqli_query($conn, "CREATE VIEW rekap AS SELECT SUM(a.nominal) AS jml, b.nama, b.k_formal, b.nis, b.t_formal, b.hp, b.desa, b.kec, b.kab, 
                            a.tahun, a.bulan, b.foto AS ket, b.pass AS kk FROM kos AS a 
                            JOIN tb_santri AS b ON a.nis = b.nis WHERE b.k_formal = '$kelas' AND b.t_formal = '$tingkat' 
                            AND a.bulan = $bulan AND a.tahun = '$tahun' AND b.ket = 0 AND aktif = 'Y' GROUP BY a.nis ");

            mysqli_query($conn, "CREATE VIEW rekap2 AS SELECT nama, nis, hp, desa, kec, kab, jkl AS bulan, stts AS tahun, foto AS ket, pass AS kk FROM tb_santri WHERE k_formal = '$kelas' AND t_formal = '$tingkat' AND ket = 0 AND aktif = 'Y' ");

            $lunas = mysqli_query($conn, "SELECT * FROM rekap WHERE jml >= 240000 ");
            $belum = mysqli_query($conn, "SELECT * FROM rekap WHERE jml < 240000 ");
            // $tidak = mysqli_query($conn, "SELECT * FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis) ");

            $kls = $kelas . ' ' . $tingkat;
            mysqli_query($conn, "INSERT INTO kirim (nama, kelas, desa, kec, kab, hp, bulan, tahun, ket, send) SELECT nama, '$kls', desa, kec, kab, hp, '$bulan', '$tahun', 'Blm lunas', 0 FROM rekap WHERE jml < 240000");
            mysqli_query($conn, "INSERT INTO kirim (nama, kelas, desa, kec, kab, hp, bulan, tahun, ket, send) SELECT nama, '$kls', desa, kec, kab, hp, '$bulan', '$tahun', 'Tak bayar', 0 FROM rekap2 WHERE NOT EXISTS (SELECT * FROM rekap WHERE rekap2.nis = rekap.nis)");
            // mysqli_query($conn, "UPDATE kirim SET bulan = $bulan, tahun = '$tahun' ");
            // UPDATE kirim SET hp = '085236924510'/
        }
        ?>
        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <?php
                        $dt = mysqli_query($conn, "SELECT * FROM kirim");
                        $kt = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kirim GROUP BY bulan, tahun"));
                        $jm = mysqli_num_rows($dt);
                        $bl = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        ?>
                        <h3 class="box-title">
                            Data dari :
                            <br />
                            <br />
                            <p class="label label-primary"> KELAS : <?= $kt['kelas']; ?></p>
                            <p class="label label-warning"> BULAN : <?= $bl[$kt['bulan']]; ?></p>
                            <p class="label label-danger"> TAHUN : <?= $kt['tahun']; ?></p>
                        </h3>
                        <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                            </span>
                            Download excel</a>
                    </div>
                    <hr>
                    <div class="box-body">
                        <form action="" method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Bulan</th>
                                            <th>Ket</th>
                                            <th>Kirim</th>
                                            <th>#</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($r = mysqli_fetch_assoc($dt)) {
                                        ?>
                                            <tr>
                                                <!--<input type="hidden" name="id_k" value="<?= $r['id_kirim'] ?>">-->
                                                <td><?= $i++; ?></td>
                                                <td><?= $r['nama']; ?></td>
                                                <td><?= $r['kelas']; ?> </td>
                                                <td><?= $bl[$kt['bulan']]; ?> <?= $r['tahun']; ?></td>
                                                <?php
                                                if ($r['ket'] == 'Blm lunas') {
                                                ?>
                                                    <td style="font-weight: bold; color: orange;"><span class="fa fa-refresh"></span>
                                                        Blm Lunas
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td style="font-weight: bold; color: red;"><span class="fa fa-times"></span>
                                                        Tak bayar
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($r['send'] == 0) {
                                                        echo "<span style='font-weight: bold; color: red;' class='fa fa-times'> Belum</span>";
                                                    } else {
                                                        echo "<span style='font-weight: bold; color: green;' class='fa fa-check'> Sudah</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="submit" name="update" class="btn btn-info btn-xs"><i class="fa fa-paper-plane"></i> send</button>
                                                    <!--<a href="<?= 'pages/info/send.php?id='.$r['id_kirim'] ?>"><button class="btn btn-info btn-xs"><i class="fa fa-paper-plane"></i> send</button></a>-->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <br>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </form>
    </div>
</section>

<?php
if (isset($_POST['update'])) {
    // $id = $_POST['id_k'];
    $thn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kirim WHERE send = 0 ORDER BY id_kirim DESC LIMIT 1"));
    $bl = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juny', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
   

        $idk = $thn['id_kirim'];
        $bn = $thn['bulan'];
        $tn = $thn['tahun'];
        $nama = '*' . $thn['nama'] . '*';
        $jns_pembayaran = '*Dekosan bulan ' . $bl[$thn['bulan']] . ' ' . $thn['tahun'] .'*';
        $desa = $thn['desa'];
        $hp = $thn['hp'];
        $kec = $thn['kec'];
        $kab = $thn['kab'];
        $spasi = '-';
        $alamat = '*' . $desa . $spasi . $kec . $spasi . $kab . '*';
        
        $pesan = '_(Ini adalah pesan otomatis dari sistem)_
    
*Assalamualaikum Wr. Wb*
Kami dari *Pengurus dekosan santri* Pesantren Darul Lughah Wal Karomahmenginfokan bahwa
    
Nama            : '. $nama.'
Alamat          : '.$alamat.'
Jnis Pembayaran : '.$jns_pembayaran.'

*_Dimohon untuk segera melunasi pembayaran tersebut_*
    
*Atas perhatiannya kami sampaikan Terimakasih*';

        $sql = mysqli_query($conn, "UPDATE kirim SET send = 1 WHERE id_kirim = $idk");
        if ($sql) {
            echo "<script>
                window.location = 'index.php?link=pages/info/info';
            </script>";
            
            $url = 'https://app.whacenter.com/api/send';
            $ch = curl_init($url);
            $data = array(
                'device_id' => 'ba05119ba4157d8214272d38ceeef5a0',
                'number' => $hp,
                'message' => $pesan,
               
            );
            $payload = $data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            // echo $result;
    
        } else {
            echo "
                <script>
                window.location = 'index.php?link=pages/info/info';
                </script>
            ";
        }
        
}
?>