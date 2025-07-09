<?php
include '../function.php';

$tujuan = $_GET['to'];

if ($tujuan == 'add_kunci') {
    $bln = $_POST['bulan'];
    $thn = $_POST['tahun'];

    $cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kunci WHERE bulan = $bln AND tahun = '$thn' "));
    if ($cek > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Maaf untuk bulan dan tahun ini sudah ada']);
    } else {
        $sql = mysqli_query($conn, "INSERT INTO kunci(nis, nama, alamat, jkl, k_formal, t_formal, kamar, komplek,  t_kos, ket, bulan, tahun) 
        SELECT nis, nama, CONCAT(desa,'-',kec,'-',kab), jkl, k_formal, t_formal, kamar, komplek, t_kos, ket, $bln, '$thn' FROM tb_santri WHERE aktif = 'Y' ");

        if ($sql) {
            echo json_encode(['status' => 'error', 'message' => 'Data baru berhasil dibuat']);
        }
    }
}
