
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Cek Data Per-Dekosan
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="" method="post">
                        <!-- Date range -->
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="">Tempat dekos</label>
                                <select name="tempat" id="" class="form-control" required>
                                    <option value=""> --pilih tempat-- </option>
                                    <option value="1">Ny. Jamilah</option>
                                    <option value="2">Gus Zaini</option>
                                    <option value="3">Ny. Farihah</option>
                                    <option value="4">Ny. Zahro</option>
                                    <option value="5">Ny. Sa'adah</option>
                                    <option value="6">Ny. Mamjudah</option>
                                    <option value="7">Ny. Naily Zulfa</option>
                                    <option value="8">Ny. Lathifah</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label><br>
                                <button type="submit" name="cari" class="btn btn-block btn-success"><span class="fa fa-search">
                                        Cek</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            $tempat = $_POST['tempat'];
            $tmp = array("-", "Ny. Jamilah", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Naily Zulfa", "Ny. Lathifah");
            $kt = array("-", "Ustad", "Khaddam", "Gratis", "Berhenti");

            $data = query("SELECT * FROM tb_santri WHERE t_kos = $tempat ");
            $jum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = $tempat "));
            $jum2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_santri WHERE t_kos = $tempat AND ket != 0 "));

        ?>
            <form action="" method="post">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                Data dari :
                                <br />
                                <br />
                                <p class="label label-primary"> JUMLAH : <?= $jum; ?> santri</p>
                                <p class="label label-warning"> GRATIS : <?= $jum2; ?> santri</p>
                                <p class="label label-danger"> SISA : <?= $jum - $jum2; ?> santri</p>
                            </h3>
                            <a href="<?= 'pages/rekap/excel_kos.php?dari=' . $dari . '&sampai=' . $sampai ?>" target="_blank" type="button" class="btn btn-success pull-right"><span class="fa fa-download">
                                </span>
                                Download excel</a>
                        </div>
                        <hr>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kelas</th>
                                            <th>Kamar</th>
                                            <th>Ket</th>
                                            <th>Tempat</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        <?php foreach ($data as $r) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $r['nis']; ?></td>
                                                <td><?= $r['nama']; ?></td>
                                                <td><?= $r['desa']; ?>, <?= $r['kec']; ?>, <?= $r['kab']; ?></td>
                                                <td><?= $r['k_formal']; ?> <?= $r['t_formal']; ?></td>
                                                <td><?= $r['kamar']; ?> / <?= $r['komplek']; ?></td>
                                                <td><?= $kt[$r['ket']]; ?></td>
                                                <td><?= $tmp[$tempat]; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
            </form>
        <?php
        }
        ?>
    </div>
</section>
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