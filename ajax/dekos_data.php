<?php
session_start();
include '../function.php';
$kt = array("Bayar", "Ustad", "Khaddam", "Gratis", "Berhenti");
// Menentukan kolom yang dapat digunakan untuk pengurutan dan pencarian
$columns = array(
    0 => 'A.id',
    1 => 'B.nama',
    2 => 'C.nama',
    3 => 'A.nominal',
    4 => 'A.bulan',
    5 => 'A.tgl',
    6 => 'B.ket'
);

$tahun_ajaran = $_SESSION['tahun'] ?? '';

// Hitung total data (tanpa filter)
$sqlTotal = "SELECT COUNT(A.id) as total FROM kos A JOIN tb_santri B ON A.nis = B.nis WHERE A.tahun = '$tahun_ajaran'";
$queryTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($queryTotal);
$totalData = $rowTotal['total'];

// Filter pencarian
$searchValue = $_POST['search']['value'];
$searchQuery = "";
if (!empty($searchValue)) {
    $searchQuery = " AND (B.nama LIKE '%$searchValue%' 
        OR C.nama LIKE '%$searchValue%' 
        OR B.ket LIKE '%$searchValue%' 
        OR A.nominal LIKE '%$searchValue%')";
}

// Hitung data setelah difilter
$sqlFiltered = "SELECT COUNT(A.id) as total 
                FROM kos A 
                JOIN tb_santri B ON A.nis = B.nis 
                LEFT JOIN tempat C ON B.t_kos = C.kd_tmp 
                WHERE A.tahun = '$tahun_ajaran' $searchQuery";
$queryFiltered = mysqli_query($conn, $sqlFiltered);
$rowFiltered = mysqli_fetch_assoc($queryFiltered);
$totalFiltered = $rowFiltered['total'];

// Pengurutan
$orderColumnIndex = $_POST['order'][0]['column'];
$orderDir = $_POST['order'][0]['dir'];
$orderColumn = $columns[$orderColumnIndex];

// Paginasi
$start = $_POST['start'];
$length = $_POST['length'];

// Query utama untuk mengambil data sub-set
$sqlData = "SELECT A.id, A.nominal, A.bulan, A.tahun, A.tgl, B.nama, C.nama as nama_tempat, B.ket 
            FROM kos A 
            JOIN tb_santri B ON A.nis = B.nis 
            LEFT JOIN tempat C ON B.t_kos = C.kd_tmp 
            WHERE A.tahun = '$tahun_ajaran' $searchQuery 
            ORDER BY $orderColumn $orderDir 
            LIMIT $start, $length";

$queryData = mysqli_query($conn, $sqlData);
$data = array();
$no = $start + 1;

while ($row = mysqli_fetch_assoc($queryData)) {
    $nestedData = array();
    $nestedData[] = $no++;
    $nestedData[] = $row['nama'];
    $nestedData[] = $row['nama_tempat'] ?? '-';
    $nestedData[] = rupiah($row['nominal']);
    $nestedData[] = bulan($row['bulan']) . " " . $row['tahun'];
    $nestedData[] = date("d-m-Y", strtotime($row['tgl']));
    $nestedData[] = $kt[$row['ket']];

    // Tombol Aksi
    $btnEdit = '<a href="index.php?link=pages/dekos/edit&id=' . $row["id"] . '"><button type="submit" name="edit" class="btn btn-warning btn-xs">Edit</button></a>';
    $btnHapus = ' <a href="index.php?link=pages/dekos/del&id=' . $row["id"] . '" onclick="return confirm(\'Yakin Akan dihapus ?\')"><button class="btn btn-danger btn-xs">Hapus</button></a>';
    $nestedData[] = $btnEdit . $btnHapus;

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval($_POST['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
