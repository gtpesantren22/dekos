
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Kirim Info Tanggungan Lama
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
                    <form action="" method="post">
                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#upload"><i class="fa fa-upload"></i> Upload Data Baru</button>
                        <button class="btn btn-danger btn-sm pull-right" type="button" data-toggle="modal" data-target="#kosong"><i class="fa fa-trash"></i> Kosongi</button>
                        <button class="btn btn-primary btn-sm pull-right" type="button" data-toggle="modal" data-target="#send"><i class="fa fa-paper-plane"></i> Kirim Data Sekarang</button>
                    </form>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Dekosan</th>
                                    <th>Syahriah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $sql = mysqli_query($conn, "SELECT * FROM info");
                                foreach ($sql as $ar) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $ar['nama']; ?></td>
                                        <td><?= $ar['kelas']; ?></td>
                                        <td>Rp. <?= number_format($ar['dekosan'], 0, ',', '.'); ?></td>
                                        <td>Rp. <?= number_format($ar['syh'], 0, ',', '.'); ?></td>
                                        <td>Rp. <?= number_format($ar['total'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="upload" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Data Tanggungan</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Pilih Berkas</label>
                        <input type="file" class="form-control" name="file" required>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-sm btn-success" type="submit" name="upload">Upload Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kosong" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kosongi Data Yanggungan</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Yakin data ini akan dikosongi</label>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-sm btn-danger" type="submit" name="kosong">Ya. Kosongi pon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="send" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pengiriman info tanggungan</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Fitur ini akan mengirim semua data yang ada. Yakin data ini akan dikirim ?</label>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn btn-sm btn-success" type="submit" name="send">Ya. Kirim pon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<?php
if (isset($_POST['upload'])) {
    // require 'libs/vendor/autoload.php';
    require_once 'excel_reader2.php';

    $target = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $target);

    chmod($_FILES['file']['name'], 07777);

    $data = new Spreadsheet_Excel_Reader($_FILES['file']['name'], false);

    $jumbar = $data->rowcount($sheet_index = 0);

    $success = 0;

    for ($i = 2; $i <= $jumbar; $i++) {

        $nama = $data->val($i, 2);
        $kelas = $data->val($i, 3);
        $hp = $data->val($i, 4);
        $dekosan =  $data->val($i, 5);
        $syh =  $data->val($i, 6);
        $total = $dekosan + $syh;

        mysqli_query($conn, "INSERT INTO info VALUES ('', '$nama', '$kelas', '$hp','$dekosan','$syh','$total')");

        $success++;
    }

    unlink($_FILES['file']['name']);

    if ($success > 0) {
        echo "
        <script>
            alert('Info berhasil');
            window.location = 'index.php?link=pages/dekos/kirim_info';
            </script>
            ";
    }
}
if (isset($_POST['kosong'])) {
    $sql = mysqli_query($conn, "TRUNCATE info");
    if ($sql) {
        echo "
        <script>
            window.location = 'index.php?link=pages/dekos/kirim_info';
        </script>
        ";
    }
}

if (isset($_POST['send'])) {
    $sql = mysqli_query($conn, "SELECT * FROM info");
    foreach ($sql as $key) {
        $nama = $key['nama'];
        $kelas = $key['kelas'];
        $dekosan = $key['dekosan'];
        $syh = $key['syh'];
        $total = $dekosan + $syh;
        $psn = '
Assalamualaikum Wr. Wb
Kami dari *BENDAHARA* Pesantren Darul Lughah Wal Karomah menginfokan bahwa
    
Nama            : ' . $nama . '
Kelas             : ' . $kelas . '

Masih memiliki Tanggungan tahun pelajaran 2021/2022, dengan rincian sebagai berikut 
1. Dekosan    : Rp. ' . number_format($dekosan, 0, ',', '.') . '
2. Syahriyah : Rp. ' . number_format($syh, 0, ',', '.') . '
    Total          : Rp. ' . number_format($total, 0, ',', '.') . '

*Dimohon untuk melunasi tanggungan tersebut*
*Jika sudah melunasi diharapkan untuk mengkonfirmasinya ke no berikut https://wa.me/6287757777273 atas nama Ust. Rizal Asayadi Mochtar*

*Atas perhatiannya kami sampaikan Terimakasih*
        ';

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'http://8.215.26.187:3000/api/sendMessage',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'apiKey=fb209be1f23625e43cbf285e57c0c0f2&phone=' . $key['hp'] . '&message=' . $psn,
            )
        );
        $response = curl_exec($curl);
        curl_close($curl);
    }
    if ($sql) {
        echo "
        <script>
            window.location = 'index.php?link=pages/dekos/kirim_info';
        </script>
        ";
    }
}
?>