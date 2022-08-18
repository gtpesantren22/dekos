<?php
//include('dbconnected.php');
include('function.php');

$id = $_GET['id'];
$thn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kirim WHERE id_kirim = '$id' "));
$bl = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juny', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

// $idk = $thn['id_kirim'];
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
Kami dari *Pengurus dekosan santri* Pesantren Darul Lughah Wal Karomah menginfokan bahwa
    
Nama            : '. $nama.'
Alamat          : '.$alamat.'
Jnis Pembayaran : '.$jns_pembayaran.'

*_Dimohon untuk segera melunasi pembayaran tersebut_*
    
*Atas perhatiannya kami sampaikan Terimakasih*';

$sql = mysqli_query($conn, "UPDATE kirim SET send = 1 WHERE id_kirim = $id ");


if ($sql) {
    echo "
        <script>
        alert('Data sudah masuk');
            document.location.href = 'index.php?link=pages/info/info';
        </script> ";
    
    $url = 'https://app.whacenter.com/api/send';

    $ch = curl_init($url);
    
    // $pesan = 'halo bos';
    
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
    echo "<script>
        alert('Data sudah tak masuk');
            window.location.href = 'index.php?link=pages/info/info';
        </script>";
}




