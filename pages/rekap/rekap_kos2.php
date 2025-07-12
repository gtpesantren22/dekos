<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Input Data Setoran
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
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <form action="" class="form-horizontal" method="post">
                        <!-- Date range -->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Pilih : </label>
                            <!-- <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tanggal" class="form-control pull-right" id="reservation"
                                        autocomplete="off" required>
                                </div>
                            </div> -->
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
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
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-gender"></i>
                                    </div>
                                    <select name="tempat" id="" class="form-control" required>
                                        <option value=""> --pilih tempat-- </option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tempat ");
                                        $no = 0;
                                        while ($thn = mysqli_fetch_array($th)) {
                                            $no++;
                                        ?>
                                            <option value="<?= $thn['kd_tmp'] ?>"><?= $thn['nama'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" name="cari" class="btn btn-success"><span class="fa fa-search"></span>
                                    Tampilkan</button>
                            </div>
                        </div><!-- /.form group -->
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['cari'])) {
            //$tgl = $_POST['tanggal'];
            $tempat = $_POST['tempat'];
            $bulan = $_POST['bulan'];

            $bln = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
            $tkos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tempat WHERE kd_tmp = $tempat  "));

        ?>
            <div id="data-setoran"></div>

            
            <!-- Toastr CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
            <!-- Toastr JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            <script>
                $(document).ready(function() {
                    loadtable(<?= $bulan ?>, '<?= $tahun_ajaran ?>', <?= $tempat ?>)
                })

                function loadtable(bulan, tahun, tkos) {
                    $.ajax({
                        type: "POST",
                        url: 'ajax/table_setoran.php',
                        dataType: 'html',
                        data: {
                            bulan: bulan,
                            tahun: tahun,
                            tkos: tkos
                        },
                        success: function(data) {
                            $('#data-setoran').html(data);
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }

                $('#simpan-form').on('submit', function(e) {
                    e.preventDefault();
                    var form = $(this);

                    $.ajax({
                        type: "POST",
                        url: 'ajax/simpan_setor.php',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message, 'Berhasil');
                                loadtable(<?= $bulan ?>, '<?= $tahun_ajaran ?>', <?= $tempat ?>)
                            } else {
                                toastr.error(response.message, 'Error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX ERROR:', status, error);
                            console.log('Response Text:', xhr.responseText);
                        }
                    })
                })

                function delItem(id) {
                    if (confirm('Yakin ingin menghapus ini ???')) {
                        $.ajax({
                            type: "POST",
                            url: 'ajax/del_setor.php',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message, 'Berhasil');
                                    loadtable(<?= $bulan ?>, '<?= $tahun_ajaran ?>', <?= $tempat ?>)
                                } else {
                                    toastr.error(response.message, 'Error');
                                }
                            },
                            error: function(xhr, status, error) {
                                alert(xhr.responseText);
                            }
                        })
                    }
                }
            </script>
        <?php
        }
        ?>
    </div>
</section>