<?php
require_once "Excel.class.php";

#koneksi ke mysql
//$mysqli = new mysqli("localhost", "root", "", "psb21");
$mysqli = new mysqli("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_bendahara");
if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi

#ambil data
$query = "SELECT nis, nik, nama, tempat, tanggal, jkl, desa, kec, kab, k_formal, t_formal, k_madin, r_madin, 
komplek, kamar, bapak, ibu, hp FROM tb_santri";

$sql = $mysqli->query($query);
$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('PSB Santri Lama - 2021.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "NIS");
$excel->writeLabel(0, 1, "NIK");
$excel->writeLabel(0, 2, "NAMA");
$excel->writeLabel(0, 3, "TMP LAHIR");
$excel->writeLabel(0, 4, "TGL LAHIR");
$excel->writeLabel(0, 5, "JKL");
$excel->writeLabel(0, 6, "DESA");
$excel->writeLabel(0, 7, "KEC");
$excel->writeLabel(0, 8, "KAB");
$excel->writeLabel(0, 9, "KLS FORMAL");
$excel->writeLabel(0, 10, "T FORMAL");
$excel->writeLabel(0, 11, "K MADIN");
$excel->writeLabel(0, 12, "R MADIN");
$excel->writeLabel(0, 13, "KOMPLEK");
$excel->writeLabel(0, 14, "KAMAR");
$excel->writeLabel(0, 15, "NAMA AYAH");
$excel->writeLabel(0, 16, "NAMA IBU");
$excel->writeLabel(0, 17, "NO HP");

#isi data
$i = 1;
foreach ($arrmhs as $baris) {
	$j = 0;
	foreach ($baris as $value) {
		$excel->writeLabel($i, $j, $value);
		$j++;
	}
	$i++;
}

$excel->EOF();

exit();
