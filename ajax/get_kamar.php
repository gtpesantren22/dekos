<?php
include '../koneksi.php';
$komplek = $_POST['komplek'];

echo "<option value=''>Pilih kamar</option>";

$query = "SELECT nama FROM kamar WHERE komplek=? ";
$dewan1 = $conn->prepare($query);
$dewan1->bind_param("s", $komplek);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
	echo "<option value='" . $row['nama'] . "'>" . $row['nama'] . "</option>";
}
?>
<!-- OK -->