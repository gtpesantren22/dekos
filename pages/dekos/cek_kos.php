<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Cek Data Dekosan (Perkelas)
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
                    <form id="form-cari" method="post">
                        <!-- Date range -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Jenjang</label>
                                <select name="t_formal" id="t_formal" class="form-control" required>
                                    <option value="">Pilih Lembaga</option>
                                    <?php
                                    $sq = mysqli_query($conn, "SELECT lembaga FROM kl_formal GROUP BY lembaga");
                                    while ($kl = mysqli_fetch_assoc($sq)) {
                                    ?>
                                        <option value="<?= $kl['lembaga'] ?>"><?= $kl['lembaga'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Kelas</label>
                                <select name="k_formal" id="k_formal" class="form-control" required>
                                    <option value="">- pilih kelas -</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="form-control" required>
                                    <option value=""> --pilih bulan-- </option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Tahun</label>
                                <select name="tahun" id="" class="form-control" required>
                                    <option value=""> --pilih tahun-- </option>
                                    <?php
                                    $th = mysqli_query($conn, "SELECT * FROM tahun ");
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
        <!-- Tempat Load Table  -->
        <div id="show-data"></div>
    </div>
</section>

<script>
    $('#form-cari').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'ajax/cek_kos.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'html',
            beforeSend: function() {
                // (opsional) tampilkan loading
                $('#show-data').html('<div class="text-center text-gray-500">Memuat data...</div>');
            },
            success: function(res) {
                $('#show-data').html(res);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#show-data').html('<div class="text-red-500 text-center">Terjadi kesalahan saat memuat data.</div>');
            }
        });
    });
</script>