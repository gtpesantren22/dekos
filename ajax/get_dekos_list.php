<?php
if (!isset($conn)) {
    include "../function.php";
}

$nis = isset($_GET['nis']) ? mysqli_real_escape_string($conn, $_GET['nis']) : (isset($nis) ? $nis : '');
$tahun = isset($_GET['tahun']) ? mysqli_real_escape_string($conn, $_GET['tahun']) : (isset($tahun) ? $tahun : '');

if (!empty($nis) && !empty($tahun)) {
    $dekos = query("SELECT * FROM kos WHERE nis = '$nis' AND tahun = '$tahun' ORDER BY bulan");
    $i = 1;
    if (!empty($dekos)) {
        foreach ($dekos as $r) {
            $bl = "";
            if ($r['bulan'] == 1) { $bl = "Januari"; }
            elseif ($r['bulan'] == 2) { $bl = "Februari"; }
            elseif ($r['bulan'] == 3) { $bl = "Maret"; }
            elseif ($r['bulan'] == 4) { $bl = "April"; }
            elseif ($r['bulan'] == 5) { $bl = "Mei"; }
            elseif ($r['bulan'] == 6) { $bl = "Juni"; }
            elseif ($r['bulan'] == 7) { $bl = "Juli"; }
            elseif ($r['bulan'] == 8) { $bl = "Agustus"; }
            elseif ($r['bulan'] == 9) { $bl = "September"; }
            elseif ($r['bulan'] == 10) { $bl = "Oktober"; }
            elseif ($r['bulan'] == 11) { $bl = "November"; }
            elseif ($r['bulan'] == 12) { $bl = "Desember"; }
            ?>
            <tr>
                <td style="font-weight: bold; text-align: center;"><?= $i; ?></td>
                <td style="font-weight: bold;"><?= $bl; ?> <?= $r['tahun']; ?></td>
                <td><?= date("d/m/Y", strtotime($r['tgl'])); ?> </td>
                <td><?= rupiah($r['nominal']); ?></td>
                <?php if ($r['stts'] == 1) { ?>
                    <td style="color: limegreen; font-weight: bold;"><span class="fa fa-check"></span> Bayar Lunas</td>
                <?php } else { ?>
                    <td style="color: orangered; font-weight: bold;"><span class="fa fa-signal"></span> Bayar Bertahap</td>
                <?php } ?>
                <td><?= $r['waktu'] ?></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-danger btn-xs btn-hapus-dekos" data-id="<?= $r['id']; ?>">
                        <span class="fa fa-trash"></span> Hapus
                    </button>
                </td>
            </tr>
            <?php
            $i++;
        }
    } else {
        ?>
        <tr>
            <td colspan="7" style="text-align: center; font-style: italic; color: #888;">Belum ada data pembayaran untuk tahun terpilih.</td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="7" style="text-align: center; font-style: italic; color: #888;">Pilih santri terlebih dahulu.</td>
    </tr>
    <?php
}
?>
