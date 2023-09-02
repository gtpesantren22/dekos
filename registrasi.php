<?php

$conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb23");
$data = mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = 'baru' ");
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
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Lembaga</th>
                <th>Tanggungan</th>
                <th>Lunas</th>
                <th>Sisa</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_array($data)) :
                $nis = $data['nis'];
                $tgn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tangg WHERE nis = $nis "));
                $tangg = $tgn['infaq'] + $tgn['buku'] + $tgn['kartu'] + $tgn['kalender'] + $tgn['seragam_pes'] + $tgn['seragam_lem'] + $tgn['orsaba'];
                $lunas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(nominal) AS jml FROM regist WHERE nis = $nis "));
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['desa'] . '-' . $d['kec'] . '-' . $d['kab'] ?></td>
                    <td><?= $d['lembaga'] ?></td>
                    <td><?= number_format($tangg) ?></td>
                    <td><?= number_format($lunas['jml']) ?></td>
                    <td><?= number_format($tangg - $lunas['jml']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>