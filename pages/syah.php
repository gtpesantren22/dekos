<?php
require 'function.php';
$santri =  query("SELECT * FROM tb_santri ORDER by nis ASC");
// if (isset($_POST["simpan"])) {
//     if (syahriah($_POST) > 0) {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/syah';
//         </script>  
// ";
//     } else {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/syah';
//         </script>   
// ";
//     }
// }
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
        <!-- left column -->
        <div class=" col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <input type="hidden" name="kasir" value="<?= $_SESSION['nama']; ?>">
                    <form method="post" action="">
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
                                    <button type="submit" name="cek" class="btn btn-primary"><span class="fa fa-check"></span></button>
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
                    </form>
                    <?php
                    if (isset($_POST['cek'])) {
                        //$nis = $_POST['no'];
                        $nis = $_POST['nis'];
                        $data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
                        $data2 =  query("SELECT * FROM syahriah WHERE nis = '$nis' ");
                        $tahun = $_POST['tahun'];
                        $syh = query("SELECT * FROM syahriah WHERE nis = '$nis' AND tahun = '$tahun' ");
                        $bayar_santri = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM syahriah WHERE nis = '$nis' AND tahun = '$tahun' "));
                        $sntr = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
                        $st1 = $sntr["stts"];
                        $byr = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM tahapan WHERE stts = '$st1' AND tahun = '$tahun' "));

                    ?>
                        <hr>
                        <form action="" method="post">
                            <input type="hidden" name="nis" value="<?= $data['nis'] ?>">
                            <input type="hidden" name="penerima" value="<?= $_SESSION['nama']; ?>">

                            <div class="col-md-7">
                                <div class="box box-success box-solid">
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama : </label>
                                                <label id="nama"> <?= $data['nama']; ?> </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Alamat : </label>
                                                <label id="desa"> <?= $data['desa']; ?> -</label>
                                                <label id="kec"> <?= $data['kec']; ?> -</label>
                                                <label id="kab"> <?= $data['kab']; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Kelas : </label>
                                                <label id="k_formal"> <?= $data['k_formal']; ?> </label>
                                                <label id="t_formal"> <?= $data['t_formal']; ?> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Kamar : </label>
                                                <label id="komplek"> <?= $data['kamar']; ?> / </label>
                                                <label id="kamar"> <?= $data['komplek']; ?> </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Status : </label>
                                                <?php $st = $data["stts"];
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
                                                    echo "<span class='label label-primary'>P. Wilyah</span>";
                                                    echo " ";
                                                }
                                                if ($ps[7] == 8) {
                                                    echo "<span class='label label-default'>Putra</span>";
                                                    echo " ";
                                                }
                                                if ($ps[8] == 9) {
                                                    echo "<span class='label label-info'>Putri</span>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Petugas : </label>
                                                <label> Ust. <?= $_SESSION['nama']; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="box box-success box-solid">
                                    <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Jumlah Pembayaran </label>
                                        <input type="text" name="nominal" id="rupiah" class="form-control" placeholder="Nominal Pembayaran" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tgl Bayar : </label>
                                        <input type="text" name="tgl" class="form-control" id="datepic" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thn Ajaran </label>
                                        <select name="tahun" id="" class="form-control" required>
                                            <option value="">-- Pilih Tahun --</option>
                                            <?php
                                            $th = mysqli_query($conn, "SELECT * FROM tahun");
                                            $nis = 0;
                                            while ($thn = mysqli_fetch_array($th)) {
                                                $nis++;
                                            ?>
                                                <option value="<?= $thn['nama'] ?>"><?= $thn['nama'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="simpan" class="btn btn-primary pull-right"><span class="fa fa-save"></span> Simpan</button>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="col-md-7">
                                <div class="box box-warning">
                                    <div class="box-header">
                                        <h3 class="box-title">Histori Pembayaran Santri</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Bayar</th>
                                                    <th>Nominal</th>
                                                    <th>Untuk Tahun</th>
                                                    <th>Penerima</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($data2 as $r) : ?>
                                                    <tr>
                                                        <th><?= $i; ?></th>
                                                        <th><?= $r['tgl']; ?></th>
                                                        <th><?= rupiah($r['nominal']); ?></th>
                                                        <th><?= $r['tahun']; ?></th>
                                                        <th><?= $r['kasir']; ?></th>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-5">
                                <div class="box box-danger">
                                    <div class="box-header">
                                        <h3 class="box-title">Keterangan Lunas</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <?php
                                        $t1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 1' AND stts = '$st1' AND tahun = '$tahun' "));
                                        $t2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 2' AND stts = '$st1' AND tahun = '$tahun' "));
                                        $t3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 3' AND stts = '$st1' AND tahun = '$tahun' "));
                                        $t4 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahapan WHERE nama = 'Tahap 4' AND stts = '$st1' AND tahun = '$tahun' "));

                                        $h1 = $bayar_santri['jml'];
                                        $h2 = $h1 - $t2['nominal'];
                                        $h3 = $h2 - $t3['nominal'];
                                        $h4 = $h3 - $t4['nominal'];
                                        ?>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th><a href="#"><?= $t1['nama'] ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th>(<?= $t1['bulan']; ?>)</th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th><?= rupiah($t1['nominal']); ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <?php if ($h1 >= $t1['nominal']) { ?>
                                                        <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                    <?php } else { ?>
                                                        <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                            Belum Lunas</th>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <th><a href="#"><?= $t2['nama'] ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th>(<?= $t2['bulan']; ?>)</th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th><?= rupiah($t2['nominal']); ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <?php if ($h2 >= $t2['nominal']) { ?>
                                                        <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                    <?php } else { ?>
                                                        <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                            Belum Lunas</th>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <th><a href="#"><?= $t3['nama'] ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th>(<?= $t3['bulan']; ?>)</th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th><?= rupiah($t3['nominal']); ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <?php if ($h3 >= $t3['nominal']) { ?>
                                                        <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                    <?php } else { ?>
                                                        <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                            Belum Lunas</th>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <th><a href="#"><?= $t4['nama'] ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th>(<?= $t4['bulan']; ?>)</th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <th><?= rupiah($t4['nominal']); ?></th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th>
                                                    <?php if ($h4 >= $t4['nominal']) { ?>
                                                        <th style="font-weight: bold; color: green;"><span class="fa fa-check"></span> Lunas</th>
                                                    <?php } else { ?>
                                                        <th style="font-weight: bold; color: red;"><span class="fa fa-close"></span>
                                                            Belum Lunas</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <a class="btn btn-primary ">Total : <?= rupiah($byr['jml']); ?></a> -
                                        <a class="btn btn-warning ">Bayar : <?= rupiah($bayar_santri['jml']); ?> </a> =
                                        <a class="btn btn-danger ">Sisa :
                                            <?= rupiah($byr['jml'] - $bayar_santri['jml']); ?> </a>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        </form>
                </div>
            <?php
                    }
            ?>
            </div><!-- /.box -->
        </div>
        <!--/.col (left) -->
    </div> <!-- /.row -->
</section><!-- /.content -->

<!-- Modal Edit Mahasiswa-->
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
if (isset($_POST['simpan'])) {

    $nis = $_POST['nis'];
    $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
    $nama = mysqli_real_escape_string($conn, $q['nama']);
    $penerima = mysqli_real_escape_string($conn, $_POST['penerima']);
    $tgl = $_POST['tgl'];
    $tahun =  $_POST['tahun'];
    $nominal =  $_POST['nominal'];
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

    $sql = mysqli_query($conn, "INSERT INTO syahriah VALUES('', $nis, '$nama', '$tgl', $nom, '$tahun', '$penerima') ");
    if ($sql) {
        $datakos = mysqli_query($conn, "select * from tb_santri a join syahriah b on a.nis=b.nis order by b.id desc limit 1");
        $nis = 0;
        while ($thn = mysqli_fetch_array($datakos)) {
            $nama = '*' . mysqli_real_escape_string($conn, $thn['nama']) . '*';
            $nominal = '*' . rupiah($thn['nominal']) . '*';
            $bulan = '*' . 'Syahriah Tahun ' . $thn['tahun'] . '*';
            $tgl_bayar = '*' . date('d-M-Y', strtotime($thn['tgl'])) . '*';
            $desa = mysqli_real_escape_string($conn, $thn['desa']);
            $hp = mysqli_real_escape_string($conn, $thn['hp']);
            $kec = mysqli_real_escape_string($conn, $thn['kec']);
            $kab = mysqli_real_escape_string($conn, $thn['kab']);
            $penerima = '*' . mysqli_real_escape_string($conn, $thn['kasir']) . '*';
            $spasi = ' ';
            $header = '_*(Ini adalah pesan otomatis dari sistem)_%0A*Assalamualaikum Wr. Wb*%0AKami dari *Pengurus Syahriyah* Pesantren Darul Lughah Wal Karomah%0Amenginfokan bahwa data dibawah ini%0A';
            $fotter = '%0A_*- Pesan ini bisa disimpan sebagai bukti pembayaran*_%0A*Terimakasih*';
            $alamat = '*' . $desa . $spasi . $kec . $spasi . $kab . '*';
        }
        echo "
        <script>
            window.location.href = 'http://e.ebilling.id/wa/bots/bot.php?wa_text=LAPORANPELANGGAN21&nama=$nama&header=$header&fotter=$fotter&wa_no=$hp&alamat=$alamat&nominal=$nominal&bulan=$bulan&tgl_bayar=$tgl_bayar&penerima=$penerima&profil=245';
        </script> ";
    } else {
        echo "
        <script>
            alert('Data tak masuk');
        </script>";
    }
}
?>
