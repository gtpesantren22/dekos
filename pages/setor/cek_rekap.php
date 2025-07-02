<section class="content-header">
    <h1><span class="fa fa-money"> </span>
        Cek Rekapan Setoran
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
                    <h3 class="box-title">Rekap Data Setoran Tahun <?= $tahun_ajaran ?></h3>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs nav-success">
                            <?php
                            $tempat = mysqli_query($conn, "SELECT * FROM tempat");
                            while ($hsl = mysqli_fetch_object($tempat)) { ?>
                                <li><a href="#tab_1" data-toggle="tab" onclick="showData('<?= $tahun_ajaran ?>',<?= $hsl->kd_tmp ?>,'<?= $hsl->nama ?>')"><?= $hsl->nama ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tab_1">
                                <div id="show-data"></div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showData(tahun, tempat, nama) {
        Swal.fire({
            title: 'Loading...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            type: "POST",
            url: "ajax/data_setoran.php",
            data: {
                tahun: tahun,
                tempat: tempat,
                nama: nama
            },
            dataType: 'html',
            success: function(data) {
                Swal.close();
                $('#show-data').html(data);
            },
            error: function(xhr, status, error) {
                Swal.close();
                alert(xhr.responseText);
            }
        })
    }
</script>