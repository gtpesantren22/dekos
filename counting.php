<?php

$conn = mysqli_connect("localhost", "u9048253_dwk", "PesantrenDWKIT2021", "u9048253_psb23");

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

$MA2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Belum Terverikasi' "));

$MA3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MA4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Belum Terverikasi' "));

$MA5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$MA6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Laki-laki' AND stts = 'Belum Terverikasi' "));

$MA7 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$MA8 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'lama' AND lembaga = 'MA' AND jkl = 'Perempuan' AND stts = 'Belum Terverikasi' "));

// --- SMK ---
$SMK1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Terverifikasi' "));

$SMK2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Laki-laki' AND stts = 'Belum Terverikasi' "));

$SMK3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Terverifikasi' "));

$SMK4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `tb_santri` WHERE ket = 'baru' AND lembaga = 'SMK' AND jkl = 'Perempuan' AND stts = 'Belum Terverikasi' "));

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

<body>
    <b>
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
    </b>
</body>

</html>