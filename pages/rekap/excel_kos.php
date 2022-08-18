<?php
//Menggabungkan dengan file koneksi yang telah kita buat
include '../../function.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap Dekosan " . date("d-F-Y") . ".xls");

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];
$kredit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jumlah FROM kos WHERE tgl BETWEEN '$dari' AND '$sampai' "));
$jum = $kredit['jumlah'];
$tgl = date("m/d/Y");
mysqli_query($conn, "INSERT INTO setor VALUES('', 'Setor ke Nyai Zahro', '$dari', '$sampai', $jum, '$tgl', '') ");
?>

<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <div align="center">
        <h2>Rekap Dekosan</h2>
        <h3>Data Tanggal : <?= date("d F Y", strtotime($dari)) ?> s/d <?= date("d F Y", strtotime($sampai)) ?></h3>

        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$no = 1;
				$query = "SELECT tgl, SUM(nominal) AS total FROM kos WHERE tgl BETWEEN '$dari' AND '$sampai' GROUP BY tgl ASC";
				//$kredit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jumlah FROM kos WHERE tgl BETWEEN '$dari' AND '$sampai' "));
				$dewan1 = $conn->prepare($query);
				$dewan1->execute();
				$res1 = $dewan1->get_result();

				if ($res1->num_rows > 0) {
					while ($row = $res1->fetch_assoc()) {
						$tgl = date("d/m/Y", strtotime($row['tgl']));
						$debet = $row['total'];

						echo "<tr>";
						echo "<td>" . $no++ . "</td>";
						echo "<td>" . $tgl . "</td>";
						echo "<td> Dekosan </td>";
						echo "<td>" . $debet . "</td>";
						echo "<td> - </td>";
						echo "<td>  </td>";
						echo "</tr>";
					}
					echo "<tr>";
					echo "<td> </td>";
					echo "<td>" . date("d/m/Y") . "</td>";
					echo "<td> Setoran ke Nyai Zahro </td>";
					echo "<td> - </td>";
					echo "<td>" . $kredit['jumlah'] . "</td>";
					echo "<td>  </td>";
					echo "</tr>";
				} else {
					echo "<tr>";
					echo "<td colspan='5'>Tidak ada data ditemukan</td>";
					echo "</tr>";
				}
				?>
            </tbody>
        </table>

        <p>www.dewankomputer.com</p>
    </div>

</body>

</html>