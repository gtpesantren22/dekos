<?php
include 'function.php';
$nis = $_GET['nis'];
$query = mysqli_query($conn, "SELECT * FROM tb_santri WHERE no ='$nis'");
$mahasiswa = mysqli_fetch_array($query);
$data = array(
    'nama'      =>  $mahasiswa['nama'],
    'desa'   =>  $mahasiswa['desa'],
    'kec'    =>  $mahasiswa['kec'],
    'kab'    =>  $mahasiswa['kab'],
    'k_formal'    =>  $mahasiswa['k_formal'],
    't_formal'    =>  $mahasiswa['t_formal'],
    'k_madin'    =>  $mahasiswa['r_madin'],
    'kamar'    =>  $mahasiswa['kamar'],
    'komplek'    =>  $mahasiswa['komplek'],
);
echo json_encode($data);
?>
<!-- OK -->