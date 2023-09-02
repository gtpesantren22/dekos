<?php

$conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb23");
// $conn = mysqli_connect("localhost", "root", "", "psb23");
$data = mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = 'baru' ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>
</head>

<body>
    <h1>Data Pendafataran Santri Baru</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Lembaga</th>
                <th>Gel</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)) :
                $nis = $d['nis'];

                $lunas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM bp_daftar WHERE nis = $nis "));
                if ($lunas) {
                    $lunas = $lunas;
                } else {
                    $lunas = 0;
                }
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['desa'] . '-' . $d['kec'] . '-' . $d['kab'] ?></td>
                    <td><?= $d['lembaga'] ?></td>
                    <td><?= $d['gel'] ?></td>
                    <td><?= ($lunas['jml']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>