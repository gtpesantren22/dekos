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
                    <form action="" id="form-cari" method="post">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tempat kos</label>
                                <select name="t_kos" id="" class="form-control" required>
                                    <option value=""> -- pilih -- </option>
                                    <?php
                                    while ($hsl = mysqli_fetch_array($sql_tmp)) {
                                        $no++;
                                    ?>
                                        <option value="<?= $hsl['kd_tmp'] ?>"><?= $hsl['kd_tmp'] . '. ' . $hsl['nama'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bulan</label>
                                <select name="bulan" id="" class="form-control" required>
                                    <option value=""> --pilih bulan-- </option>
                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                        <option value="<?= $i; ?>"><?= $bulan_data[$i]; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div><!-- /.input group -->
                        </div>
                        <div class="col-md-3">
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
        <!-- Hasil load -->
        <div id="show-data"></div>
    </div>
</section>
<script>
    $('#form-cari').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'ajax/cek_kos3.php',
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