<?php
include '../function.php';

$id = $_POST['id'];

$save = mysqli_query($conn, "DELETE FROM setor WHERE id = $id");
if ($save) {
    echo json_encode(['status' => 'success', 'message' => 'Hapus berhasil']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Hapus gagal']);
}
