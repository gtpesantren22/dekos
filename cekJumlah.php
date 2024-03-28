<?php
include 'function.php';
$tahun = mysqli_query($conn, "SELECT tahun FROM kunci GROUP BY tahun ");
$tmpKos = array("-", "Ny. Jamilah", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Naily Zulfa", "Ny. Lathifah", "Ny. Um");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .single-border-table {
            border-collapse: collapse;
            width: 100%;
        }

        .single-border-table td,
        .single-border-table th {
            border: 1px solid black;
            /* Atur ketebalan dan warna garis sesuai kebutuhan */
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php
    while ($th = mysqli_fetch_assoc($tahun)) {
        $thn = $th['tahun'];
    ?>
        <b>Tahun : <?= $thn ?></b>
        <table class="single-border-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tempat</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Aprl</th>
                    <th>Mei</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Agust</th>
                    <th>Sept</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Des</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $tmp = mysqli_query($conn, "SELECT t_kos FROM kunci WHERE tahun = '$thn' AND (t_kos = 1 OR t_kos = 2 OR t_kos = 3) GROUP BY t_kos");
                while ($tm = mysqli_fetch_assoc($tmp)) {
                    $nmTkos = $tm['t_kos'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tmpKos[$nmTkos] ?></td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 1 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 2 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 3 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 4 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 5 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 6 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 7 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 8 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 9 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 10 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 11 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                        <td>
                            <?php
                            $totalJumlah = 0;
                            $sql = mysqli_query($conn, "SELECT k_formal, COUNT(nama) AS jml FROM kunci WHERE tahun = '$thn' AND t_kos = '$nmTkos' AND (k_formal = 'IX' OR k_formal = 'XII' OR k_formal = 9 OR k_formal = 3 OR k_formal = 12) AND bulan = 12 GROUP BY k_formal ");
                            while ($hsl = mysqli_fetch_assoc($sql)) {
                                echo $hsl['k_formal'] . " = " . $hsl['jml'] . "</br>";
                                $totalJumlah += $hsl['jml'];
                            }
                            echo "<b>Total : " . $totalJumlah . "</b>";
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
    <?php } ?>
</body>

</html>