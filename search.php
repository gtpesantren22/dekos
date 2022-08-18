<?php
include "function.php"; // Load file koneksi.php

$nis = $_POST['nis']; // Ambil data NIS yang dikirim lewat AJAX

$query = mysqli_query($conn, "SELECT * FROM tb_santri WHERE no ='" . $nis . "'"); // Tampilkan data siswa dengan NIS tersebut
$row = mysqli_num_rows($query); // Hitung ada berapa data dari hasil eksekusi $query

if ($row > 0) { // Jika data lebih dari 0
	$data = mysqli_fetch_array($query); // ambil data siswa tersebut

	// BUat sebuah array
	$callback = array(
		'status' => 'success', // Set array status dengan success
		'nama' => $data['nama'], // Set array nama dengan isi kolom nama pada tabel siswa
		'desa' => $data['desa'], // Set array jenis_kelamin dengan isi kolom jenis_kelamin pada tabel siswa
		'kec' => $data['kec'], // Set array jenis_kelamin dengan isi kolom telp pada tabel siswa
		'kab' => $data['kab'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa
		'k_formal' => $data['k_formal'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa
		't_formal' => $data['t_formal'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa
		'kamar' => $data['kamar'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa
		'komplek' => $data['komplek'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa
	);
} else {
	$callback = array('status' => 'failed'); // set array status dengan failed
}

echo json_encode($callback); // konversi varibael $callback menjadi JSON
?>
<!-- OK -->