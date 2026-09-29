<?php
include_once('function.php');

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($id > 0) {
    $del = mysqli_query($conn, "DELETE FROM kos WHERE id = $id");
    if ($del) {
        echo "<script>
            alert('Data pembayaran berhasil dihapus');
            window.location.href = 'index.php?link=pages/dekos/dekos';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data pembayaran');
            window.location.href = 'index.php?link=pages/dekos/dekos';
        </script>";
    }
} else {
    echo "<script>
        window.location.href = 'index.php?link=pages/dekos/dekos';
    </script>";
}
?>
<!-- OK -->