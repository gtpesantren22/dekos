<?php

//Koneksi
$dbUser = "root";
$dbPass = "";
$dbName = "bendahara";
$dbHost = "localhost";
$conn = mysqli_connect("localhost", "root", "", "db_dekos");
$conn2 = mysqli_connect("localhost", "root", "", "db_santri");
// $conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_dekos");
// $conn2 = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_santri");

$tarif = 300000;
$sql_tmp = mysqli_query($conn, "SELECT * FROM tempat");
$bulan_data = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");

function bulan($bulan)
{
    $bulan_data = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
    $retur = $bulan != '' ? $bulan_data[$bulan] : 'Bulan Salah';
    return $retur;
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function syahriah($data)
{
    global $conn;
    $nis = $data['nis'];
    $q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
    $nama = mysqli_real_escape_string($conn, $q['nama']);
    $penerima = mysqli_real_escape_string($conn, $data['penerima']);
    $tgl = $data['tgl'];
    $tahun =  $data['tahun'];
    $nominal =  $data['nominal'];
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

    mysqli_query($conn, "INSERT INTO syahriah VALUES('', $nis, '$nama', '$tgl', $nom, '$tahun', '$penerima') ");
    mysqli_affected_rows($conn);
}

function edit_syahriah($data)
{
    global $conn;
    $id = $data['id'];
    $nominal =  $data['nominal'];
    $tahun = $data['tahun'];
    $tgl = $data['tgl'];

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

    mysqli_query($conn, "UPDATE syahriah SET nominal = $nom, tahun = '$tahun', tgl = '$tgl' WHERE id = $id");
    mysqli_affected_rows($conn);
}

function del_syahriah($id)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM syahriah WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function add_masuk($data)
{
    global $conn;
    $item = htmlspecialchars(mysqli_real_escape_string($conn, $data['item']));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));
    $tgl = date('Y-m-d', strtotime($data['tgl']));
    $nominal = $data['nominal'];
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
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $data['penerima']));
    $kode = "M_" . uniqid();

    mysqli_query($conn, "INSERT INTO masuk VALUES('', '$kode', '$item', '$nama', $nom, '$tgl', '$penerima') ");
    mysqli_query($conn, "INSERT INTO kas VALUES('', '$kode', '$item', '$tgl', '$nama', $nom, 0, 'M') ");
    mysqli_affected_rows($conn);
}

function edit_masuk($data)
{
    global $conn;
    //$id = $data['id'];
    $kode = $data['kode'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));
    $item = htmlspecialchars(mysqli_real_escape_string($conn, $data['item']));
    $nominal = $data['nominal'];
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

    mysqli_affected_rows($conn);
    mysqli_query($conn, "UPDATE masuk SET item = '$item', nama = '$nama', nominal = $nom WHERE kode = '$kode' ");
    mysqli_query($conn, "UPDATE kas SET item = '$item', nama = '$nama', masuk = $nom WHERE kode = '$kode' ");
}

function del_masuk($kode)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM masuk WHERE kode = '$kode' ");
    mysqli_query($conn,  "DELETE FROM kas WHERE kode = '$kode' ");

    return mysqli_affected_rows($conn);
}

function add_tahun($data)
{
    global $conn;
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));

    mysqli_query($conn, "INSERT INTO tahun VALUES('', '$nama') ");
    mysqli_affected_rows($conn);
}

function edit_tahun($data)
{
    global $conn;
    $id = $data['id'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));

    mysqli_affected_rows($conn);
    mysqli_query($conn, "UPDATE tahun SET nama = '$nama' WHERE id = $id");
}

function del_tahun($id)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM tahun WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function add_akun($data)
{
    global $conn;
    $kode = htmlspecialchars(mysqli_real_escape_string($conn, $data['kode']));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));

    mysqli_query($conn, "INSERT INTO item VALUES('', '$kode', '$nama') ");
    mysqli_affected_rows($conn);
}

function edit_akun($data)
{
    global $conn;
    $id = $data['id'];
    $kode = htmlspecialchars(mysqli_real_escape_string($conn, $data['kode']));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));

    mysqli_affected_rows($conn);
    mysqli_query($conn, "UPDATE item SET kode_i = '$kode', nama_i = '$nama' WHERE id_item = $id");
}

function del_akun($id)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM item WHERE id_item = $id");

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek ada tidak nya gambar yang diuplload
    if ($error === 4) {
        echo "
        <script>
        alert('Anda Tidak Mengupload Gambar');
        </script> ";
        return false;
    }

    //ketentuan gambar yang diupload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
        alert('Yang Anda upload bukan Gambar');
        </script> ";
        return false;
    }

    //Cer Ukuran gambar
    if ($ukuranFile > 500000) {
        echo "
        <script>
            alert('Ukuran gambar yang diupload terlalu besar');
        </script> ";
        return false;
    }

    // penamaan file agar rendome
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    //upload nama file dan file setelah beberapa filter
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function add_keluar($data)
{
    global $conn;
    $tgl = htmlspecialchars(mysqli_real_escape_string($conn, date('Y-m-d',  strtotime($data['tgl']))));
    $kode = date('m', strtotime($tgl)) . date('y', strtotime($tgl));
    $dd = mysqli_fetch_array(mysqli_query($conn, "SELECT max(substring(no_nota, 6)) as maxKode FROM keluar WHERE no_nota LIKE '$kode%' "));
    if ($dd['maxKode'] == '') {
        $kodeBarang = '000';
    } else {
        $kodeBarang = $dd['maxKode'];
    }
    $noUrut = (int) substr($kodeBarang, 0, 3);
    $noUrut++;
    $kodeBarang = $kode . '_' . sprintf("%03s", $noUrut);
    $inv = htmlspecialchars($kodeBarang);

    $item = htmlspecialchars(mysqli_real_escape_string($conn, $data['item']));
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));
    $no_nota = $inv;
    $pemohon = htmlspecialchars(mysqli_real_escape_string($conn, $data['pemohon']));
    $nominal = $data['nominal'];
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

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        $gambar = "";
    }
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $data['penerima']));
    $kodeN = "K_" . uniqid();

    mysqli_query($conn, "INSERT INTO keluar VALUES('', '$kodeN', '$item', '$nama', '$no_nota', '$pemohon', $nom, '$gambar', '$tgl', '$penerima') ");
    mysqli_query($conn, "INSERT INTO kas VALUES('', '$kodeN', '$item', '$tgl', '$nama', 0, $nom, 'K') ");
    mysqli_affected_rows($conn);
}

function edit_keluar($data)
{
    global $conn;
    $kode = $data['kode'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));
    $item = htmlspecialchars(mysqli_real_escape_string($conn, $data['item']));
    $pemohon = htmlspecialchars(mysqli_real_escape_string($conn, $data['pemohon']));
    $nominal = $data['nominal'];
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
    $gambarLama  = htmlspecialchars($data['gambarLama']);
    //cek apakah user upliad gambar atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    mysqli_query($conn, "UPDATE keluar SET nama = '$nama', item = '$item', pemohon = '$pemohon', nominal = $nom, foto = '$gambar' WHERE kode = '$kode'");
    mysqli_query($conn, "UPDATE kas SET nama = '$nama', item = '$item', keluar = $nom WHERE kode = '$kode' ");
    mysqli_affected_rows($conn);
}

function del_keluar($kode)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM keluar WHERE kode = '$kode' ");
    mysqli_query($conn,  "DELETE FROM kas WHERE kode = '$kode' ");

    return mysqli_affected_rows($conn);
}


function ganti_pass($data)
{
    global $conn;
    $id = $data['id'];
    $pass = htmlspecialchars(mysqli_real_escape_string($conn, $data['pass']));

    mysqli_query($conn, "UPDATE tb_santri SET pass = '$pass' WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function add_dekos($data)
{
    global $conn;
    $nis = htmlspecialchars(mysqli_real_escape_string($conn, $data['nis']));
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $data['penerima']));
    $bln = $data['bln'];
    $thn = $data['thn'];
    $nominal = $data['nominal'];
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
    $tanggal = htmlspecialchars(mysqli_real_escape_string($conn, $data['tgl']));
    $penerima = htmlspecialchars(mysqli_real_escape_string($conn, $data['penerima']));
    $waktu = date('d-m-Y H:i');

    if ($nom > 240000) {
        echo "
        <script>
            alert('Maaf, Pembayaran MaX. Rp. 240.000 per bulan');
        </script>
        ";
        return false;
    }

    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos WHERE nis = '$nis' AND bulan = $bln AND tahun = '$thn' "));
    if ($cek['total'] == 240000) {
        echo "
        <script>
            alert('Pembayaran Bulan ini sudah Lunas');
        </script>
        ";
        return false;
    }

    $byr = $cek['total'] + $nom;
    if ($byr > 240000) {
        echo "
        <script>
            alert('Santri ini sudah pernah melakukan pembayaran sebelumnya, Mohon dicek kembali');
        </script>
        ";
        return false;
    }

    if ($nom == 240000) {
        $stts = 1;
    } else {
        $stts = 2;
    }

    mysqli_query($conn, "INSERT INTO kos VALUES('', '$nis', $nom, $bln, '$thn', '$tanggal', '$penerima', $stts, '$waktu') ");
    mysqli_affected_rows($conn);
}

function edit_dekos($data)
{
    global $conn;
    $id = $data['id'];
    $nis = $data['nis'];
    $bln = $data['bln'];
    $thn = $data['thn'];
    $nominal = $data['nominal'];
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
    $tanggal = htmlspecialchars(mysqli_real_escape_string($conn, $data['tgl']));
    if ($nom > 240000) {
        echo "
        <script>
            alert('Maaf, Pembayaran MaX. Rp. 240.000 per bulan');
        </script>
        ";
        return false;
    }

    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos WHERE nis = '$nis' AND bulan = $bln AND tahun = $thn "));
    $byr = $cek['total'] + $nom;
    // if ($byr > 240000) {
    //     echo "
    //     <script>
    //         alert('Pembayaran melebihi batas Maksimal Pembayaran');
    //     </script>
    //     ";
    //     return false;
    // }

    if ($nom == 240000) {
        $stts = 1;
    } else {
        $stts = 2;
    }

    mysqli_affected_rows($conn);
    mysqli_query($conn, "UPDATE kos SET nominal = $nom, bulan = $bln, tahun = $thn, tgl = '$tanggal', stts = $stts  WHERE id = $id ");
}

function del_dekos($id)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM kos WHERE id = $id ");

    return mysqli_affected_rows($conn);
}


function edit_setor($data)
{
    global $conn;
    $id = $data['id'];
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $data['nama']));
    $ket = htmlspecialchars(mysqli_real_escape_string($conn, $data['ket']));
    $tgl = htmlspecialchars(mysqli_real_escape_string($conn, $data['tgl']));
    $penyetor = htmlspecialchars(mysqli_real_escape_string($conn, $data['penyetor']));

    mysqli_query($conn, "UPDATE setor SET nama = '$nama', dari = '$ket', sampai = '$ket', tgl = '$tgl', penyetor = '$penyetor' WHERE id = $id ");
    mysqli_affected_rows($conn);
}

function del_setor($id)
{
    global $conn;
    mysqli_query($conn,  "DELETE FROM setor WHERE id = $id ");

    return mysqli_affected_rows($conn);
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function rmRp($string)
{
    return preg_replace("/[^0-9]/", "", $string);
}
