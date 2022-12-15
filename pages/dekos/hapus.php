<?php

require 'function.php';

$kd = $_GET['kd'];
$id = $_GET['id'];

if ($kd === 'tks') {
    $sql = mysqli_query($conn, "DELETE FROM kosmen WHERE t_kos = $id ");
    if ($sql) {
        echo "
        <script>
            alert('Data sudah dihapus');
            window.location = 'index.php?link=pages/dekos/roll';
        </script>
        ";
    }
}