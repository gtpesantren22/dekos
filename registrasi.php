<?php

$data = mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = 'baru' ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Registrasi</title>
</head>

<body>
    <h1>Data Registrasi Santri Baru</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Lembaga</th>
                <th>Tanggungan</th>
                <th>Lunas</th>
                <th>Sisa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)) :
                $nis = $d['nis'];
                $tgn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tanggungan WHERE nis = $nis "));

                if ($tgn) {
                    $tangg = $tgn['infaq'] + $tgn['buku'] + $tgn['kartu'] + $tgn['kalender'] + $tgn['seragam_pes'] + $tgn['seragam_lem'] + $tgn['orsaba'];
                } else {
                    $tangg = 0;
                }

                $lunas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM regist WHERE nis = $nis "));
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
                    <td><?= ($tangg) ?></td>
                    <td><?= ($lunas['jml']) ?></td>
                    <td><?= ($tangg - $lunas['jml']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>