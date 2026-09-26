<?php
header('Content-Type: application/json');
include "../function.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Metode request tidak didukung"]);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "ID tidak valid"]);
    exit;
}

$del = mysqli_query($conn, "DELETE FROM kos WHERE id = $id");

if ($del) {
    echo json_encode(["status" => "success", "message" => "Pembayaran berhasil dihapus!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menghapus pembayaran dari database"]);
}
?>
