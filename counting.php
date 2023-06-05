<?php

$conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb23");
// $conn = mysqli_connect("localhost", "root", "", "psb23");

// --- RA ---
$RA1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'RA' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$RA2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'RA' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$RA3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'RA' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$RA4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'RA' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));


// --- MI ---
$MI1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MI' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$MI2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MI' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$MI3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MI' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MI4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MI' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));


// --- MTs ---
$MTs1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MTs' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$MTs2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MTs' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$MTs3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MTs' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MTs4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MTs' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));


// --- SMP ---
$SMP1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMP' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$SMP2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMP' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$SMP3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMP' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$SMP4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMP' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));


// --- MA ---
$MA1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$MA2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$MA3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MA4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));

$MA5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$MA6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Belum Terverikasi' "));

$MA7 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MA8 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Belum Terverikasi' "));

// --- SMK ---
$SMK1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$SMK2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Belum Terverifikasi' "));

$SMK3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$SMK4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Belum Terverifikasi' "));

$SMK5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$SMK6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Belum Terverikasi' "));

$SMK7 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$SMK8 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Belum Terverikasi' "));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .table1 {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }

    .table1,
    th,
    td {
        border: 1px solid #999;
        padding: 8px 20px;
    }
</style>

<body>
    <!-- <b>
        <?php

        echo  $RA1 . '<br>';
        echo  $RA2 . '<br>';
        echo  $RA3 . '<br>';
        echo  $RA4 . '<br>';
        echo  $MI1 . '<br>';
        echo  $MI2 . '<br>';
        echo  $MI3 . '<br>';
        echo  $MI4 . '<br>';
        echo $MTs1 . '<br>';
        echo $MTs2 . '<br>';
        echo $MTs3 . '<br>';
        echo $MTs4 . '<br>';
        echo $SMP1 . '<br>';
        echo $SMP2 . '<br>';
        echo $SMP3 . '<br>';
        echo $SMP4 . '<br>';
        echo $MA1 . '<br>';
        echo $MA2 . '<br>';
        echo $MA3 . '<br>';
        echo $MA4 . '<br>';
        echo $MA5 . '<br>';
        echo $MA6 . '<br>';
        echo $MA7 . '<br>';
        echo $MA8 . '<br>';
        echo $SMK1 . '<br>';
        echo $SMK2 . '<br>';
        echo $SMK3 . '<br>';
        echo $SMK4 . '<br>';
        echo $SMK5 . '<br>';
        echo $SMK6 . '<br>';
        echo $SMK7 . '<br>';
        echo $SMK8 . '<br>';


        ?>
    </b> -->
    <table class="table1">
        <tr>
            <td><?= $RA1 ?></td>
            <td><?= $RA2 ?></td>
            <td><?= $RA3 ?></td>
            <td><?= $RA4 ?></td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td><?= $MI1 ?></td>
            <td><?= $MI2 ?></td>
            <td><?= $MI3 ?></td>
            <td><?= $MI4 ?></td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td><?= $MTs1 ?></td>
            <td><?= $MTs2 ?></td>
            <td><?= $MTs3 ?></td>
            <td><?= $MTs4 ?></td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td><?= $SMP1 ?></td>
            <td><?= $SMP2 ?></td>
            <td><?= $SMP3 ?></td>
            <td><?= $SMP4 ?></td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr>
            <td><?= $MA1 ?></td>
            <td><?= $MA2 ?></td>
            <td><?= $MA3 ?></td>
            <td><?= $MA4 ?></td>
            <td><?= $MA5 ?></td>
            <td><?= $MA6 ?></td>
            <td><?= $MA7 ?></td>
            <td><?= $MA8 ?></td>
        </tr>
        <tr>
            <td><?= $SMK1 ?></td>
            <td><?= $SMK2 ?></td>
            <td><?= $SMK3 ?></td>
            <td><?= $SMK4 ?></td>
            <td><?= $SMK5 ?></td>
            <td><?= $SMK6 ?></td>
            <td><?= $SMK7 ?></td>
            <td><?= $SMK8 ?></td>
        </tr>
    </table>
</body>

</html>