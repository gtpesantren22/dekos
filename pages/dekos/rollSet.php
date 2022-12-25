<?php
require 'function.php';
$kd = $_GET['kd'];

if ($kd === 'dekos') {
    $sql = mysqli_query($conn, "UPDATE tb_santri a, kosmen b SET a.t_kos = b.t_kos WHERE a.nis = b.nis AND a.t_kos IS NULL ");
    if ($sql) {
        echo "
        <script>
            alert('Data sudah dipindah');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
    }
}