<?php
require "Excel.class.php";

#koneksi ke mysql
//$mysqli = new mysqli("localhost", "root", "", "psb21");
if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi

#ambil data
$query = "SELECT * FROM tb_santri";

$sql = $mysqli->query($query);
$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('Data Satri Baru 2021.xls');
#$excel->EX();
$excel->BOF();

#header tabel

$excel->writeLabel(0, 0, "ID");
$excel->writeLabel(0, 1, "NIS");
$excel->writeLabel(0, 2, "NAMA");
$excel->writeLabel(0, 3, "TMP LAHIR");
$excel->writeLabel(0, 4, "TGL LAHIR");
$excel->writeLabel(0, 5, "JKL");
$excel->writeLabel(0, 6, "DESA");
$excel->writeLabel(0, 7, "KEC");
$excel->writeLabel(0, 8, "KAB");
$excel->writeLabel(0, 9, "KLS FORML");
$excel->writeLabel(0, 10, "TING F");
$excel->writeLabel(0, 11, "KLS MADIN");
$excel->writeLabel(0, 12, "RM MADIN");
$excel->writeLabel(0, 13, "KOMPLEK");
$excel->writeLabel(0, 14, "KAMAR");
$excel->writeLabel(0, 15, "NAMA AYAH");
$excel->writeLabel(0, 16, "NAMA IBU");
$excel->writeLabel(0, 17, "HP");
$excel->writeLabel(0, 18, "PASS");
$excel->writeLabel(0, 19, "FOTO");
$excel->writeLabel(0, 20, "STTS");
$excel->writeLabel(0, 21, "T KOS");
$excel->writeLabel(0, 22, "KET");

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
