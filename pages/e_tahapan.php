<?php
include('function.php');
$bln = array(
    1 => "Januari", "Februari", "Maret", "April", "Mei",
    "Juni", "Juli", "Agustus", "September", "Oktober",
    "November", "Desember"
);

if ($id = $_GET["id"]) {
    //$id = $_POST['rowid'];
    $id = $_GET["id"];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM tb_santri WHERE nis = $id";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $row) { ?>


<body class="hold-transition skin-blue sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <h1>
            Edit Data Santri
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Seluruh Santri</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="index.php?link=pages/action_tahapan&aksi=edit" method="post">
                            <?php
                                    $st = explode("-", $row['stts']);

                                    $tgl = $row['tanggal'];
                                    $split = explode('-', $tgl);
                                    $tgl_a = $split[0];
                                    $bln_a =  $split[1];
                                    $thn_a = $split[2];
                                    ?>
                            <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Tetala</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="tempat" class="form-control"
                                            value="<?php echo $row['tempat']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="tgl" id="" class="form-control">
                                            <option value=""> -Tanggal- </option>
                                            <?php
                                                    for ($tanggal = 1; $tanggal <= 31; $tanggal++) {
                                                        $i = $tanggal;
                                                        if ($tgl_a == $i) {
                                                            echo "<option value=$i selected>$i</option>";
                                                        } else {
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                        echo "<option value=$i>$i</option>";
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="bulan" id="" class="form-control">
                                            <option value=""> -Bulan- </option>
                                            <?php
                                                    for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                        if ($bln_a == $bulan) {
                                                            echo "<option value=$bulan selected>$bln[$bulan]</option>";
                                                        } else {
                                                            echo "<option value=$bulan>$bln[$bulan]</option>";
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="tahun" id="" class="form-control">
                                            <option value=""> -Tahun- </option>
                                            <?php
                                                    $now = date("Y");
                                                    for ($tahun = 1990; $tahun <= $now; $tahun++) {
                                                        if ($thn_a == $tahun) {
                                                            echo "<option value=$tahun selected>$tahun</option>";
                                                        } else {
                                                            echo "<option value=$tahun>$tahun</option>";
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <label>&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;</label>
                                <input type="radio" name="jkl" class="custom-control-input" value="Laki-laki"
                                    <?php if ($row['jkl'] == 'Laki-laki') {
                                                                                                                            echo "checked";
                                                                                                                        } ?> required><span class="custom-control-label"> Laki-laki</span>
                                <input type="radio" name="jkl" class="custom-control-input" value="Perempuan"
                                    <?php if ($row['jkl'] == 'Perempuan') {
                                                                                                                            echo "checked";
                                                                                                                        } ?> required><span class="custom-control-label"> Perempuan</span>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="desa" class="form-control" placeholder="Desa"
                                    value="<?php echo $row['desa']; ?>">
                                <input type="text" name="kec" class="form-control" placeholder="kecamatan"
                                    value="<?php echo $row['kec']; ?>">
                                <input type="text" name="kab" class="form-control" placeholder="Kabupaten"
                                    value="<?php echo $row['kab']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Kelas Formal</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="k_formal" id="" class="form-control" required>
                                            <?php
                                                    $k_f = $row["k_formal"];
                                                    if (isset($k_f)) : ?>
                                            <option value="<?= $k_f; ?>"><?= $k_f; ?></option>
                                            <?php endif; ?>
                                            <option value="">---------------</option>
                                            <option value="VII"> VII / 7 </option>
                                            <option value="VIII"> VIII / 8 </option>
                                            <option value="IX"> IX / 9 </option>
                                            <option value="X"> X / 10 </option>
                                            <option value="XI"> XI / 11 </option>
                                            <option value="XII"> XII / 12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="t_formal" id="" class="form-control" required>
                                            <?php
                                                    $k_f = $row["t_formal"];
                                                    if (isset($k_f)) : ?>
                                            <option value="<?= $k_f; ?>"><?= $k_f; ?></option>
                                            <?php endif; ?>
                                            <option value="">---------------</option>
                                            <option value="MTs"> MTs </option>
                                            <option value="SMP"> SMP </option>
                                            <option value="MA"> MA </option>
                                            <option value="SMK"> SMK </option>
                                            <option value="mhs"> Mahasiswa </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelas Madin</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="k_madin" id="" class="form-control" required>
                                            <?php
                                                    $k_f = $row["k_madin"];
                                                    if (isset($k_f)) : ?>
                                            <option value="<?= $k_f; ?>"><?= $k_f; ?></option>
                                            <?php endif; ?>
                                            <option value="">---------------</option>
                                            <option value="Shifir"> Shifir/I'dad </option>
                                            <option value="1"> 1 </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            <option value="6"> 6 </option>
                                            <option value="Ust"> Ust </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="r_madin" id="" class="form-control" required>
                                            <?php
                                                    $k_f = $row["r_madin"];
                                                    if (isset($k_f)) : ?>
                                            <option value="<?= $k_f; ?>"><?= $k_f; ?></option>
                                            <?php endif; ?>
                                            <option value="">---------------</option>
                                            <option value="A"> A </option>
                                            <option value="B"> B </option>
                                            <option value="C"> C </option>
                                            <option value="D"> D </option>
                                            <option value="E"> E </option>
                                            <option value="F"> F </option>
                                            <option value="G"> G </option>
                                            <option value="H"> H </option>
                                            <option value="I"> I </option>
                                            <option value="J"> J </option>
                                            <option value="K"> K </option>
                                            <option value="L"> L </option>
                                            <option value="M"> M </option>
                                            <option value="N"> N </option>
                                            <option value="O"> O </option>
                                            <option value="P"> P </option>
                                            <option value="Q"> Q </option>
                                            <option value="R"> R </option>
                                            <option value="S"> S </option>
                                            <option value="T"> T </option>
                                            <option value="U"> U </option>
                                            <option value="V"> V </option>
                                            <option value="W"> W </option>
                                            <option value="X"> X </option>
                                            <option value="Y"> Y </option>
                                            <option value="Z"> Z </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Komplek</label>
                                <input type="text" name="komplek" class="form-control"
                                    value="<?php echo $row['komplek']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Kamar</label>
                                <input type="text" name="kamar" class="form-control"
                                    value="<?php echo $row['kamar']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Bapak</label>
                                <input type="text" name="bapak" class="form-control"
                                    value="<?php echo $row['bapak']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <input type="text" name="ibu" class="form-control" value="<?php echo $row['ibu']; ?>">
                            </div>
                            <div class="form-group">
                                <label>No. HP</label>
                                <input type="text" name="hp" class="form-control" value="<?php echo $row['hp']; ?>">
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
                                        <td>Bersaudara/i Kandung</td>
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

                            <div class="modal-footer">
                                <button type="submit" name="update" class="btn btn-warning"><span class="fa fa-check">
                                    </span> Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                        class="fa fa-close">
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

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- OK -->
    </section><!-- /.content -->
    <script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    </script>
    </body>

</html>