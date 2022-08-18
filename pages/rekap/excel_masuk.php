<?php
require_once "Excel.class.php";

#koneksi ke mysql
$mysqli = new mysqli("localhost", "root", "", "bendahara");
if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_error . ') ');
}
#akhir koneksi

#ambil data
$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

$query = "SELECT id, nama, nominal, tgl, penerima FROM masuk WHERE tgl BETWEEN '$dari' AND '$sampai' ORDER by id ASC";
$sql = $mysqli->query($query);
$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
	array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
$tg = date("d F Y");
#Send Header
$excel->setHeader('Data Pemasukan (' . $tg . ').xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "ID");
$excel->writeLabel(0, 1, "URAIAN");
$excel->writeLabel(0, 2, "NOMINAL");
$excel->writeLabel(0, 3, "TANGGAL TERIMA");
$excel->writeLabel(0, 4, "PENERIMA");
$excel->writeLabel(0, 5, "--");
$excel->writeLabel(0, 6, "Data : " . date("d F Y", strtotime($dari)) . " s/d " . date("d F Y", strtotime($sampai)));
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