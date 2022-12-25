<?php
require 'function.php';
$kd = $_GET['kd'];

if ($kd === 'dekos') {
    $sql = mysqli_query($conn, "UPDATE tb_santri a, kosmen b SET a.t_kos = b.t_kos WHERE a.nis = b.nis ");
    if ($sql) {
        echo "
        <script>
            alert('Data sudah dipindah');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
    }
}

if ($kd === 'ulang') {

    mysqli_query($conn, "TRUNCATE tb_santri");
    // $sql = mysqli_query($conn2, "INSERT INTO db_dekos.tb_santri SELECT * FROM db_santri.tb_santri ");
    $sql = mysqli_query($conn2, "INSERT INTO u9048253__dekos.tb_santri SELECT * FROM u9048253__santri.tb_santri ");
    if ($sql) {
        echo "
        <script>
            alert('Data sudah dimuat ulang');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
    }
}