<?php


if (isset($_GET['aksi'])) {
    switch ($_GET['aksi']) {

        case "add":
            add($conn);
            break;
        case "edit":
            edit($conn);
            break;
        case "edit3":
            edit3($conn);
            break;

        default:
            echo "<h3>Aksi <i>" . $_GET['aksi'] . "</i> tidaka ada!</h3>";
    }
}

function add($conn)
{
    if (isset($_POST['save'])) {
        // $tm = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["tm"]));

        // $data = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(nis) as maxKode FROM tb_santri WHERE nis LIKE '$tm%'"));
        // $kodeBarang = $data['maxKode'];
        // $noUrut = (int) substr($kodeBarang, 5, 3);
        //$noUrut = $kodeBarang;
        // $noUrut++;
        // $char = $tm . "2";
        // $kodeBarang = $char . sprintf("%03s", $noUrut);
        //$nis = $kodeBarang;

        $nis = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["nis"]));
        $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["nama"]));
        $tempat = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["tempat"]));

        $tgl = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["tgl"]));
        $bulan = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["bulan"]));
        $tahun = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["tahun"]));
        $tanggal = $tgl . "-" . $bulan . "-" . $tahun;

        $jkl = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["jkl"]));
        $desa = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["desa"]));
        $kec = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["kec"]));
        $kab = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["kab"]));
        $k_formal = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["k_formal"]));
        $t_formal = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["t_formal"]));
        $k_madin = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["k_madin"]));
        $r_madin = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["r_madin"]));
        $komplek = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["komplek"]));
        $kamar = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["kamar"]));
        $bapak = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["bapak"]));
        $ibu = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["ibu"]));
        $hp = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["hp"]));
        $t_kos = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["t_kos"]));
        $stts = $_POST['usd'] . "-" . $_POST['mhs'] . "-" . $_POST['sdr'] . "-" . $_POST['kls6'] . "-" . $_POST['br'] . "-" . $_POST['lm'] . "-" . $_POST['pwl'] . "-" . $_POST['pa'] . "-" . $_POST['pi'];

        $qr = "INSERT INTO tb_santri VALUES ('', '$nis', '$nama', '$tempat', '$tanggal', '$jkl',
        '$desa', '$kec', '$kab', '$k_formal', '$t_formal', '$k_madin', '$r_madin', '$komplek', '$kamar', '$bapak', '$ibu', '$hp', '', '', '$stts',
		'$t_kos', 0) ";

        // mysqli_query($conn, $qr);

        if (mysqli_query($conn, $qr)) {
            echo "
           <script>
            alert('Data masuk!');
            window.location.href = 'index.php?link=pages/santri';
            </script>
           ";
        } else {
            echo "
            <script>
            alert('Data tak masuk!');
            window.location.href = 'index.php?link=pages/add';
            </script>
           ";
        }
    }
}

function edit($conn)
{
    if (isset($_POST['update'])) {
        $nis = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nis"]));
        $nama = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama"]));
        $tempat = mysqli_real_escape_string($conn, htmlspecialchars($_POST["tempat"]));
        $tgl = mysqli_real_escape_string($conn, htmlspecialchars($_POST["tgl"]));
        $bulan = mysqli_real_escape_string($conn, htmlspecialchars($_POST["bulan"]));
        $tahun = mysqli_real_escape_string($conn, htmlspecialchars($_POST["tahun"]));
        $tanggal = $tgl . "-" . $bulan . "-" . $tahun;
        $jkl = mysqli_real_escape_string($conn, htmlspecialchars($_POST["jkl"]));
        $desa = mysqli_real_escape_string($conn, htmlspecialchars($_POST["desa"]));
        $kec = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kec"]));
        $kab = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kab"]));
        $k_formal = mysqli_real_escape_string($conn, htmlspecialchars($_POST["k_formal"]));
        $t_formal = mysqli_real_escape_string($conn, htmlspecialchars($_POST["t_formal"]));
        $k_madin = mysqli_real_escape_string($conn, htmlspecialchars($_POST["k_madin"]));
        $r_madin = mysqli_real_escape_string($conn, htmlspecialchars($_POST["r_madin"]));
        $komplek = mysqli_real_escape_string($conn, htmlspecialchars($_POST["komplek"]));
        $kamar = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kamar"]));
        $bapak = mysqli_real_escape_string($conn, htmlspecialchars($_POST["bapak"]));
        $ibu = mysqli_real_escape_string($conn, htmlspecialchars($_POST["ibu"]));
        $hp = mysqli_real_escape_string($conn, htmlspecialchars($_POST["hp"]));
        $stts = $_POST["usd"] . "-" . $_POST["mhs"] . "-" . $_POST["sdr"] . "-" . $_POST["kls6"] . "-" . $_POST["br"] . "-" . $_POST["lm"] . "-" . $_POST["pwl"] . "-" . $_POST["pa"] . "-" . $_POST["pi"];

        //Query
        $query = "UPDATE tb_santri SET nis = '$nis', nama = '$nama', tempat='$tempat', tanggal = '$tanggal', jkl = '$jkl', 
    desa = '$desa', kec = '$kec', kab = '$kab', k_formal = '$k_formal', t_formal = '$t_formal', k_madin = '$k_madin',
    r_madin = '$r_madin', komplek = '$komplek', kamar = '$kamar', bapak = '$bapak', ibu = '$ibu', hp = '$hp', stts = '$stts' WHERE nis = '$nis' ";


        if (mysqli_query($conn, $query)) {
            echo "
            <script>
                window.location.href = 'index.php?link=pages/santri';
            </script>
            ";
        } else {
            echo "
            <script>
				alert('Data Gagal. Mohon cek kembali !!');
                window.location.href = 'index.php?link=pages/add';
            </script>
            ";
        }
    }
}



?>

<!-- Ok -->