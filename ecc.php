<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data.xls");
?>
<body>
    <table border="1">
        <?php
        require 'function.php';
        $dt = mysqli_query($conn, "SELECT * FROM kunci WHERE bulan = 8 AND tahun = '2021/2022' ");
        while ($a = mysqli_fetch_assoc($dt)) { ?>
        <tr>
            <td><?= $a['nis'] ?></td>
            <td><?= $a['nama'] ?></td>
            <td><?= $a['alamat'] ?></td>
            <td><?= $a['t_kos'] ?></td>
            <td><?= $a['ket'] ?></td>
            <td><?= $a['bulan'] ?></td>
            <td><?= $a['tahun'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>