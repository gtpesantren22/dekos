<?php

$data = mysqli_query($conn, "SELECT * FROM tb_santri WHERE ket = 'baru' AND gel = 3 AND lembaga != 'MI' AND lembaga != 'RA' ORDER BY nama ASC ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gelombang 3</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>NAMA</th>
                <th>ALAMAT</th>
                <th>JKL</th>
                <th>LEMBAGA</th>
                <th>GEL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($d = mysqli_fetch_array($data)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nis'] ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['desa'] . '-' . $d['kec'] . '-' . $d['kab'] ?></td>
                    <td><?= $d['jkl'] ?></td>
                    <td><?= $d['lembaga'] ?></td>
                    <td><?= $d['gel'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>