<?php
require 'function.php';
$santri =  query("SELECT * FROM tb_santri WHERE aktif = 'Y' ORDER by nis ASC");
// if (isset($_POST["simpan"])) {
//     if (add_dekos($_POST) > 0) {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/dekos/add';
//         </script>  
// ";
//     } else {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/dekos/add';
//         </script>   
// ";
//     }
// }
?>
<section class="content-header">
    <h1>
        Input Data dekos
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form" id="myform" action="" method="post">
                    <div class="box-body">
                        <div class="col-md-2">
                            <label for="">Tahun </label>
                            <select name="tahun" id="" class="form-control" required>
                                <?php
                                $th = mysqli_query($conn, "SELECT * FROM tahun ORDER BY id DESC");
                                $nis = 0;
                                while ($thn = mysqli_fetch_array($th)) {
                                    $nis++;
                                ?>
                                    <option value="<?= $thn['nama'] ?>" cele><?= $thn['nama'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>NIS Santri</label>
                                <td>
                                    <input type="text" name="nis" id="nis" class="form-control" autocomplete="off" placeholder="Scan Kartu Santri" autofocus="autofocus" required>
                                </td>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for=""><span class="fa fa-check"></span></label><br>
                                <td>
                                    <button type="submit" name="cari" class="btn btn-primary"><span class="fa fa-check"></span></button>
                                </td>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""><span class="fa fa-search"> </span></label><br>
                                <td>
                                    <a href="#" type="button" data-toggle="modal" class="btn btn-success " data-target="#tambah"><span class="fa fa-search"> </span>
                                        Cari Santri</a>
                                </td>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $nis = $_POST['nis'];
            $tahun = $_POST['tahun'];
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
            $dekos =  query("SELECT * FROM kos WHERE nis = '$nis' AND tahun = '$tahun' ORDER BY bulan ");
            $tm = array("-", "Ny. Jamilah", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Naily Z.", "Ny. Lathifah");

        ?>
            <div class="col-md-6">
                <div class="callout callout-success">
                    <h4><span class="fa fa-bullhorn"></span> Info Santri</h4>
                    <br>
                    <table celspacing="5" celpadding="5">
                        <tr>
                            <th rowspan="6"><img src="" alt="" height="130px" width="100px"></th>
                            <th style="padding: 3px 10px">NIS</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $data['nis'] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">Nama</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $data['nama'] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">Kelas</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $data['k_formal'] ?> <?= $data['t_formal'] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">Alamat</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $data['desa'] ?> - <?= $data['kec'] ?> - <?= $data['kab'] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">Kamar</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $data['kamar'] ?> / <?= $data['komplek'] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">Dekos</th>
                            <th style="padding: 3px 10px">:</th>
                            <th style="padding: 3px 10px"><?= $tm[$data['t_kos']] ?></th>
                        </tr>
                        <tr>
                            <th style="padding: 3px 10px">&nbsp;</th>
                            <th style="padding: 3px 10px">&nbsp;</th>
                            <th style="padding: 3px 10px">&nbsp;</th>
                            <th style="padding: 3px 10px">&nbsp;</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="" method="post">
                        <input type="hidden" name="nis" value="<?= $nis; ?>">
                        <input type="hidden" name="penerima" value="<?= $_SESSION['nama']; ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Nominal</label>
                                <div class="col-sm-10">
                                    <!--<select class="form-control" name="nominal" required>-->
                                    <!--    <option value="Rp. 120.000">Rp. 120.000</option>-->
                                    <!--    <option value="Rp. 240.000">Rp. 240.000</option>-->
                                    <!--</select>-->
                                    <input type="text" class="form-control" name="nominal" id="rupiah" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Bulan</label>
                                <div class="col-sm-5">
                                    <select name="bln" id="" class="form-control" required>
                                        <option value="">-- Pilih Bulan --</option>
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
                                </div>
                                <div class="col-sm-5">
                                    <select name="thn" id="" class="form-control" required>
                                        <option value="">-- Pilih Tahun --</option>
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
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tgl" id="datepic" required autocomplete="off">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" name="save" class="btn btn-success pull-right"><span class="fa fa-check"></span> Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="" method="post">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align: center; color: white; background-color: lightseagreen; font-size: 30px;">
                                                #
                                            </th>
                                            <th rowspan="2" style="text-align: center; color: white; background-color: lightseagreen; font-size: 30px;">
                                                Bulan
                                            </th>
                                            <th colspan="2" style="text-align: center; color: white; background-color: lightskyblue;">Bayar
                                            </th>
                                            <th rowspan="2" style="text-align: center; color: white; background-color: lightsalmon; font-size: 30px;">
                                                Ket
                                            </th>
                                            <th rowspan="2" style="text-align: center; color: white; background-color: lightsalmon; font-size: 30px;">
                                                Waktu
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style=" color: white; background-color: lightsteelblue;">Tgl. Bayar</th>
                                            <th style=" color: white; background-color: lightsteelblue;">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($dekos as $r) : ?>
                                            <?php
                                            if ($r['bulan'] == 1) {
                                                $bl = "Januari";
                                            } elseif ($r['bulan'] == 2) {
                                                $bl = "Feburari";
                                            } elseif ($r['bulan'] == 3) {
                                                $bl = "Maret";
                                            } elseif ($r['bulan'] == 4) {
                                                $bl = "April";
                                            } elseif ($r['bulan'] == 5) {
                                                $bl = "Mei";
                                            } elseif ($r['bulan'] == 6) {
                                                $bl = "juni";
                                            } elseif ($r['bulan'] == 7) {
                                                $bl = "Juli";
                                            } elseif ($r['bulan'] == 8) {
                                                $bl = "Agustus";
                                            } elseif ($r['bulan'] == 9) {
                                                $bl = "September";
                                            } elseif ($r['bulan'] == 10) {
                                                $bl = "Oktober";
                                            } elseif ($r['bulan'] == 11) {
                                                $bl = "November";
                                            } elseif ($r['bulan'] == 12) {
                                                $bl = "Desember";
                                            }
                                            ?>

                                            <tr>
                                                <td style="font-weight: bold; text-align: center;"><?= $i; ?></td>
                                                <td style="font-weight: bold;"><?= $bl; ?> <?= $r['tahun']; ?></td>
                                                <td><?= date("d/m/Y", strtotime($r['tgl'])); ?> </td>
                                                <td><?= rupiah($r['nominal']); ?></td>
                                                <?php if ($r['stts'] == 1) { ?>
                                                    <td style="color: limegreen; font-weight: bold;"><span class="fa fa-check"></span>
                                                        Bayar Lunas</td>
                                                <?php } else { ?>
                                                    <td style="color: orangered; font-weight: bold;"><span class="fa fa-signal"></span>
                                                        Bayar Bertahap</td>
                                                <?php } ?>
                                                <td><?= $r['waktu'] ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        <?php
        }
        ?>
    </div> <!-- /.row -->
</section><!-- /.content -->


<!-- Cari Santri-->
<div class="modal fade" id="tambah" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Tahapan</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <table id="example1_bst" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($santri as $r) : ?>
                                    <tr>
                                        <td><a id="data" onClick="masuk(this,'<?= $r["nis"]; ?>')" href="javascript:void(0)"><?= $r["nis"]; ?></a></td>
                                        <td><?= $r["nama"]; ?> </td>
                                        <td><?= $r["k_formal"]; ?> <?= $r["t_formal"]; ?> / <?= $r["k_madin"]; ?>
                                            <?= $r["r_madin"]; ?> </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close">
                        </span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

if (isset($_POST['save'])) {
    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis']));
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['penerima']));
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];
    $nominal = $_POST['nominal'];
    if (empty($nominal)) {
        $nom = 0;
    } else if (strlen($nominal) <= 11) {
        $angka = substr($nominal, 4);
        $angka2 = explode(".", $angka);
        $nom = $angka2[0] . $angka2[1];
    } else if (strlen($nominal) <= 15) {
        $angka = substr($nominal, 4);
        $angka2 = explode(".", $angka);
        $nom = $angka2[0] . $angka2[1] . $angka2[2];
    } else if (strlen($nominal) >= 17) {
        $angka = substr($nominal, 4);
        $angka2 = explode(".", $angka);
        $nom = $angka2[0] . $angka2[1] . $angka2[2] . $angka2[3];
    }
    $tanggal =  $_POST['tgl'];
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['penerima']));
    $waktu = date('d-m-Y H:i');

    if ($nom > 300000) {
        echo "
        <script>
            alert('Maaf, Pembayaran MaX. Rp. 300.000 per bulan');
        </script>
        ";
        return false;
    }

    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos WHERE nis = '$nis' AND bulan = $bln AND tahun = '$thn' "));
    if ($cek['total'] == 300000) {
        echo "
        <script>
            alert('Pembayaran Bulan ini sudah Lunas');
        </script>
        ";
        return false;
    }

    $byr = $cek['total'] + $nom;
    if ($byr > 300000) {
        echo "
        <script>
            alert('Santri ini sudah pernah melakukan pembayaran sebelumnya, Mohon dicek kembali');
        </script>
        ";
        return false;
    }

    if ($nom == 300000) {
        $stts = 1;
    } else {
        $stts = 2;
    }


    $ins = mysqli_query($conn, "INSERT INTO kos VALUES('', '$nis', $nom, $bln, '$thn', '$tanggal', '$penerima', $stts, '$waktu') ");
    if ($ins) {
        $datakos = mysqli_query($conn, "select * from tb_santri a join kos b on a.nis=b.nis order by b.id desc limit 1");

        $bl = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juny', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        while ($thn = mysqli_fetch_array($datakos)) {
            $nis = $thn['nis'];
            $bn = $thn['bulan'];
            $tn = $thn['tahun'];
            $qr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS tt FROM kos WHERE nis = '$nis' AND bulan = '$bn' AND tahun = '$tn' "));
            if ($qr['tt'] >= 300000) {
                $kt = 'Sudah Lunas';
            } else {
                $kt = 'Belum lunas';
            }
            $nama = '*' . mysqli_real_escape_string($conn, $thn['nama']) . '*';
            $nominal = '*' . rupiah($thn['nominal']) . '*';
            $bulan = '*' . $bl[$thn['bulan']] . ' ' . $thn['tahun'] . '*';
            $tgl_bayar = '*' . date('d-M-Y', strtotime($thn['tgl'])) . '*';
            $desa = mysqli_real_escape_string($conn, $thn['desa']);
            $hp = mysqli_real_escape_string($conn, $thn['hp']);
            $kec = mysqli_real_escape_string($conn, $thn['kec']);
            $kab = mysqli_real_escape_string($conn, $thn['kab']);
            $penerima = '*' . mysqli_real_escape_string($conn, $thn['penerima']);
            $spasi = ' ';
            $alamat = '*' . $desa . $spasi . $kec . $spasi . $kab . '*';

            $pesan = '
            _(Ini adalah pesan otomatis dari sistem)_
*Assalamualaikum Wr. Wb*
Kami dari *Pengurus dekosan* santri Pesantren Darul Lughah Wal Karomah
menginfokan bahwa data dibawah ini : 

Nama : ' . $nama . '
Alamat : ' . $alamat . '
Nominal Pembayaran: ' . $nominal . '
Tanggal Bayar : ' . $tgl_bayar . '
Pembayaran Untuk: ' . $bulan . '
Penerima: ' . $penerima . '*
Keterangan : *' . $kt . '*

_*- Pesan ini bisa disimpan sebagai bukti pembayaran*_
*Terimakasih*';
        }

        echo "
        <script>
        alert('Pembayaran berhasil');
        window.location = 'index.php?link=pages/dekos/add' ;
        </script>";

        $url = 'https://app.whacenter.com/api/send';
        $ch = curl_init($url);
        // $pesan = $pesan;
        $data = array(
            'device_id' => 'ba05119ba4157d8214272d38ceeef5a0',
            'number' => $hp,
            // 'number' => '085236924510',
            'message' => $pesan,

        );
        $payload = $data;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    } else {
        echo "
        <script>
        alert('Gagal masuk');
        </script>";
    }
}

?>