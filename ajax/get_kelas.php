<?php
include '../function.php';
$t_formal = $_POST['t_formal'];

echo "<option value=''>Pilih Kelas</option>";

$query = "SELECT nama FROM kelas WHERE lembaga=? ";
$dewan1 = $conn->prepare($query);
$dewan1->bind_param("s", $t_formal);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
	echo "<option value='" . $row['nama'] . "'>" . $row['nama'] . "</option>";
}
?>
<!-- OK -->