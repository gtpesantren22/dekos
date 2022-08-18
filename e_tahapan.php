<?php
include('function.php');
if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM tahapan WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $row) { ?>

<form role="form" action="action_tahapan.php?aksi=edit" method="post">
    <?php
            $st = explode("-", $row['stts']);
            ?>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <div class="form-group">
        <label>Nama</label>
        <select name="nama" id="" class="form-control" required>
            <option value="<?= $row['nama'] ?>"><?= $row['nama'] ?>
            <option value=""> ---- </option>
            <option value="Tahap 1"> Tahap 1 </option>
            <option value="Tahap 2"> Tahap 2 </option>
            <option value="Tahap 3"> Tahap 3 </option>
            <option value="Tahap 4"> Tahap 4 </option>
        </select>
    </div>

    <div class="form-group">
        <label>Bulan</label>
        <input type="text" name="bulan" class="form-control" value="<?php echo $row['bulan']; ?>">
    </div>
    <div class="form-group">
        <label>Status</label>
        <table border="0">
            <tr>
                <td>
                    <?php if ($st[0] == 1) {
                                echo '<input type="checkbox" name="usd" value="1" checked>';
                            } else {
                                echo '<input type="checkbox" name="usd" value="1">';
                            } ?>
                </td>
                <td rowspan="3">&nbsp;</td>
                <td>Ustad/Ustadzah</td>
                <td rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <?php if ($st[1] == 2) {
                                echo '<input type="checkbox" name="mhs" value="2" checked>';
                            } else {
                                echo '<input type="checkbox" name="mhs" value="2">';
                            } ?>
                </td>
                <td rowspan="3">&nbsp;</td>
                <td>Mahasiswa/i</td>
                <td>
                    <?php if ($st[2] == 3) {
                                echo '<input type="checkbox" name="sdr" value="3" checked>';
                            } else {
                                echo '<input type="checkbox" name="sdr" value="3">';
                            } ?>
                </td>
                <td rowspan="3">&nbsp;</td>
                <td>Bersaudara/i</td>
            </tr>
            <tr>
                <td>
                    <?php if ($st[3] == 4) {
                                echo '<input type="checkbox" name="kls6" value="4" checked>';
                            } else {
                                echo '<input type="checkbox" name="kls6" value="4">';
                            } ?>
                </td>
                <td>Kelas 6</td>
                <td>
                    <?php if ($st[4] == 5) {
                                echo '<input type="checkbox" name="br" value="5" checked>';
                            } else {
                                echo '<input type="checkbox" name="br" value="5">';
                            } ?>
                </td>
                <td>Santi Baru</td>
                <td>
                    <?php if ($st[7] == 8) {
                                echo '<input type="checkbox" name="pa" value="8" checked>';
                            } else {
                                echo '<input type="checkbox" name="pa" value="8">';
                            } ?>
                </td>
                <td>Putra</td>
            </tr>
            <tr>
                <td>
                    <?php if ($st[5] == 6) {
                                echo '<input type="checkbox" name="lm" value="6" checked>';
                            } else {
                                echo '<input type="checkbox" name="lm" value="6">';
                            } ?>
                </td>
                <td>Santi Lama</td>
                <td>
                    <?php if ($st[6] == 7) {
                                echo '<input type="checkbox" name="pwl" value="7" checked>';
                            } else {
                                echo '<input type="checkbox" name="pwl" value="7">';
                            } ?>
                </td>
                <td>Pengurus Wilayah</td>
                <td>
                    <?php if ($st[8] == 9) {
                                echo '<input type="checkbox" name="pi" value="9" checked>';
                            } else {
                                echo '<input type="checkbox" name="pi" value="9">';
                            } ?>
                </td>
                <td>Putri</td>
            </tr>
        </table>
    </div>
    <div class="form-group">
        <label>Nominal</label>
        <input type="text" name="nominal" class="form-control" id="rupiah" value="<?= rupiah($row['nominal']); ?>">
    </div>
    <div class="form-group">
        <label>Tahun</label>
        <select name="tahun" id="" class="form-control">
            <option value="<?= $row['tahun'] ?>" selected><?= $row['tahun'] ?></option>
            <option value="">-------------</option>
            <?php
                    $th = mysqli_query($conn, "SELECT * FROM tahun");
                    $no = 0;
                    while ($thn = mysqli_fetch_array($th)) {
                        $no++;
                    ?>
            <option value="<?= $thn['nama'] ?>"><?= $thn['nama'] ?>
            </option>
            <?php
                    }
                    ?>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-warning"><span class="fa fa-check"> </span> Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close">
            </span> Close</button>
    </div>

    <?php
    }
    //mysql_close($host);
        ?>
</form>
<?php
}
    ?>
<!-- OK -->

<script type="text/javascript">
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>