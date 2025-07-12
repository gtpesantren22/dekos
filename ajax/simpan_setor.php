<?php
include '../function.php';

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$nominal = rmRp($_POST['nominal']);
$tanggal = $_POST['tanggal'];
$via = $_POST['via'];
$tempat = $_POST['tempat'];
$penyetor = $_POST['penyetor'];

$jmlSantri = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM kunci WHERE t_kos = $tempat AND tahun = '$tahun' AND ket = 0 AND bulan = $bulan "));
$setor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) as total FROM setor WHERE bulan = $bulan AND tahun = '$tahun' AND t_kos = $tempat "));
$jmlSetor = $setor['total'] != null ? $setor['total'] : 0;
$psr90 = (90 / 100) * ($jmlSantri['jml'] * $tarif);
$sisa = $psr90 - $jmlSetor;

if ($nominal > $sisa) {
    echo json_encode(['status' => 'error', 'message' => 'Nominal melebihi batas']);
} else {
    $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM setor WHERE tahun = '$tahun' AND bulan = $bulan AND t_kos = $tempat "));
    $dari = !$cek || $cek == 0 ? 'Setoran ke - 1' : 'Setoran ke - ' . $cek + 1;
    $save = mysqli_query($conn, "INSERT INTO setor (nama,dari,sampai,bulan,tahun,pa,pi,nominal,tgl,penyetor,t_kos,via) VALUES ('Setoran','$dari','$dari','$bulan','$tahun',0,0,$nominal,'$tanggal','$penyetor',$tempat,'$via')");
    if ($save) {
        echo json_encode(['status' => 'success', 'message' => 'Simpan berhasil']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Simpan gagal']);
    }
}
