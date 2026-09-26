<?php
header('Content-Type: application/json');
include "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Metode request tidak didukung"]);
    exit;
}

$nis = isset($_POST['nis']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis'])) : '';
$bln = isset($_POST['bln']) ? intval($_POST['bln']) : 0;
$thn = isset($_POST['thn']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['thn'])) : '';
$nominal = isset($_POST['nominal']) ? $_POST['nominal'] : '';
$tanggal = isset($_POST['tgl']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['tgl'])) : '';
$penerima = isset($_POST['penerima']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['penerima'])) : '';
$waktu = date('d-m-Y H:i');

if (empty($nis) || empty($bln) || empty($thn) || empty($nominal) || empty($tanggal)) {
    echo json_encode(["status" => "error", "message" => "Harap lengkapi semua field form"]);
    exit;
}

// Convert formatted Rupiah (e.g. "Rp. 120.000") to numeric integer
$nom = intval(preg_replace('/[^0-9]/', '', $nominal));

if ($nom <= 0) {
    echo json_encode(["status" => "error", "message" => "Nominal pembayaran tidak valid"]);
    exit;
}

if ($nom > 300000) {
    echo json_encode(["status" => "error", "message" => "Maaf, Pembayaran Max. Rp. 300.000 per bulan"]);
    exit;
}

$cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS total FROM kos WHERE nis = '$nis' AND bulan = $bln AND tahun = '$thn' "));
if ($cek['total'] == 300000) {
    echo json_encode(["status" => "error", "message" => "Pembayaran Bulan ini sudah Lunas"]);
    exit;
}

$byr = $cek['total'] + $nom;
if ($byr > 300000) {
    echo json_encode(["status" => "error", "message" => "Santri ini sudah pernah melakukan pembayaran sebelumnya, Mohon dicek kembali"]);
    exit;
}

if ($nom == 300000) {
    $stts = 1;
} else {
    $stts = 2;
}

$ins = mysqli_query($conn, "INSERT INTO kos(nis, nominal, bulan, tahun, tgl, penerima, stts, waktu) VALUES( '$nis', $nom, $bln, '$thn', '$tanggal', '$penerima', $stts, '$waktu') ");

if ($ins) {
    // Fetch newly saved record details to send WhatsApp notification
    $datakos = mysqli_query($conn, "SELECT a.nama, a.desa, a.kec, a.kab, a.hp, b.nis, b.bulan, b.tahun, b.tgl, b.nominal, b.penerima FROM tb_santri a JOIN kos b ON a.nis=b.nis ORDER BY b.id DESC LIMIT 1");
    $bl = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    echo json_encode(["status" => "success", "message" => "Pembayaran berhasil disimpan!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan data ke database"]);
}
