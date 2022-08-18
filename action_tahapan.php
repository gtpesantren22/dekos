<?php
include('function.php');

if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {
        case "tambah":
            tambah($conn);
            break;
        case "edit":
            edit($conn);
            break;
        case "hapus":
            hapus($conn);
            break;
        default:
            echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidaka ada!</h3>";
    }
}

function tambah($conn)
{
    if (isset($_POST['tambah'])) {

        $nama = $_POST['nama'];
        $bulan = $_POST['bulan'];
        $stts = $_POST['usd'] . "-" . $_POST['mhs'] . "-" . $_POST['sdr'] . "-" . $_POST['kls6'] . "-" . $_POST['br'] . "-" . $_POST['lm'] . "-" . $_POST['pwl'] . "-" . $_POST['pa'] . "-" . $_POST['pi'];
        $nominal = $_POST['nominal'];
        if (empty($nominal)) {
            $u_pes = 0;
        } else if (strlen($nominal) == 10) {
            $res = substr($nominal, 4, 2);
            $res1 = substr($nominal, 7, 3);
            $nom = $res . $res1;
        } else if (strlen($nominal) == 11) {
            $res = substr($nominal, 4, 3);
            $res1 = substr($nominal, 8, 3);
            $nom = $res . $res1;
        } else {
            $res = substr($nominal, 4, 1);
            $res1 = substr($nominal, 6, 3);
            $res2 = substr($nominal, 10, 3);
            $nom = $res . $res1 . $res2;
        }
        $tahun = $_POST['tahun'];

        //query update
        $query = "INSERT INTO tahapan VALUES ('', '$nama', '$bulan', '$stts', $nom, '$tahun') ";

        if (mysqli_query($conn, $query)) {
            # credirect ke page index
            header("location:index.php?link=pages/tahapan");
        } else {
            echo "ERROR, data gagal diupdate";
        }
    }
}

function edit($conn)
{
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $bulan = $_POST['bulan'];
        $stts = $_POST['usd'] . "-" . $_POST['mhs'] . "-" . $_POST['sdr'] . "-" . $_POST['kls6'] . "-" . $_POST['br'] . "-" . $_POST['lm'] . "-" . $_POST['pwl'] . "-" . $_POST['pa'] . "-" . $_POST['pi'];
        $nominal = $_POST['nominal'];
        if (empty($nominal)) {
            $u_pes = 0;
        } else if (strlen($nominal) == 10) {
            $res = substr($nominal, 4, 2);
            $res1 = substr($nominal, 7, 3);
            $nom = $res . $res1;
        } else if (strlen($nominal) == 11) {
            $res = substr($nominal, 4, 3);
            $res1 = substr($nominal, 8, 3);
            $nom = $res . $res1;
        } else {
            $res = substr($nominal, 4, 1);
            $res1 = substr($nominal, 6, 3);
            $res2 = substr($nominal, 10, 3);
            $nom = $res . $res1 . $res2;
        }
        $tahun = $_POST['tahun'];

        //query update
        $query = "UPDATE tahapan SET nama='$nama', bulan='$bulan', stts='$stts', nominal='$nom', tahun='$tahun' WHERE id='$id' ";

        if (mysqli_query($conn, $query)) {
            # credirect ke page index
            header("location:index.php?link=pages/tahapan");
        } else {
            echo "ERROR, data gagal diupdate";
        }
    }
}

function hapus($conn)
{
    if (isset($_GET['id']) && isset($_GET['aksi'])) {
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM tahapan WHERE id =" . $id;
        $hapus = mysqli_query($conn, $sql_hapus);

        if ($hapus) {
            if ($_GET['aksi'] == 'hapus') {
                header('location: index.php?link=pages/tahapan');
            }
        }
    }
}
?>

<!-- Ok -->