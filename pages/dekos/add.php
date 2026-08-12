<?php

$santri =  query("SELECT * FROM tb_santri WHERE aktif = 'Y' ORDER by nis ASC");
// if (isset($_POST["simpan"])) {
//     if (add_dekos($_POST) > 0) {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/dekos/add';
//         </script>  
// ";
//     } else {
//         echo "
//         <script>
//             window.location.href = 'index.php?link=pages/dekos/add';
//         </script>   
// ";
//     }
// }
?>
<section class="content-header">
    <h1>
        Input Data dekos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Input Data</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form" id="myform" action="index.php?link=pages/dekos/add" method="post">
                    <div class="box-body">
                        <div class="col-md-2">
                            <label for="">Tahun </label>
                            <select name="dekos_tahun" id="" class="form-control" required>
                                <?php
                                $th = mysqli_query($conn, "SELECT * FROM tahun ORDER BY id DESC");
                                while ($thn = mysqli_fetch_array($th)) {
                                    $selected = ($thn['nama'] == $_SESSION['tahun']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $thn['nama'] ?>" <?= $selected ?>><?= $thn['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>NIS Santri</label>
                                <td>
                                    <input type="text" name="nis" id="nis" class="form-control" autocomplete="off" placeholder="Scan Kartu Santri" autofocus="autofocus" required>
                                </td>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for=""><span class="fa fa-check"></span></label><br>
                                <td>
                                    <button type="submit" name="cari" class="btn btn-primary"><span class="fa fa-check"></span></button>
                                </td>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""><span class="fa fa-search"> </span></label><br>
                                <td>
                                    <a href="#" type="button" data-toggle="modal" class="btn btn-success " data-target="#tambah"><span class="fa fa-search"> </span>
                                        Cari Santri</a>
                                </td>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
        <div id="dekos-detail-container"></div>
    </div> <!-- /.row -->
</section><!-- /.content -->

<!-- Cari Santri-->
<div class="modal fade" id="tambah" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cari Data Santri</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example1_bst" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($santri as $r) : ?>
                                <tr>
                                    <td><a id="data" onClick="masuk(this,'<?= $r["nis"]; ?>')" href="javascript:void(0)"><?= $r["nis"]; ?></a></td>
                                    <td><?= $r["nama"]; ?> </td>
                                    <td><?= $r["k_formal"]; ?> <?= $r["t_formal"]; ?> / <?= $r["k_madin"]; ?> <?= $r["r_madin"]; ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Intercept search form submission
    $('#myform').on('submit', function(e) {
        e.preventDefault();
        loadDekosDetail();
    });

    // Intercept clicking on "Cari" button
    $('button[name="cari"]').on('click', function(e) {
        e.preventDefault();
        loadDekosDetail();
    });

    // Handle student select in modal: update NIS and trigger search automatically!
    window.masuk = function(txt, data) {
        document.getElementById('nis').value = data;
        $("#tambah").modal('hide');
        loadDekosDetail();
    };

    function loadDekosDetail() {
        var nis = $('#nis').val();
        var tahun = $('select[name="dekos_tahun"]').val();
        
        if (!nis) {
            alert('Harap masukkan NIS Santri terlebih dahulu!');
            return;
        }

        $('#dekos-detail-container').html('<div class="col-md-12 text-center" style="padding: 50px;"><i class="fa fa-spinner fa-spin fa-3x text-green"></i><h4>Memuat data santri...</h4></div>');

        $.ajax({
            type: 'POST',
            url: 'ajax/get_dekos_detail.php',
            data: { nis: nis, tahun: tahun },
            success: function(html) {
                $('#dekos-detail-container').html(html);
                
                // Initialize jquery widgets/plugins on dynamically loaded elements
                $('#datepic').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });

                // Re-bind rupiah mask keyup listener for dynamically loaded #rupiah input
                var rupiah = document.getElementById('rupiah');
                if (rupiah) {
                    rupiah.addEventListener('keyup', function(e) {
                        rupiah.value = formatRupiah(this.value, 'Rp. ');
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#dekos-detail-container').html('<div class="col-md-12"><div class="alert alert-danger">Gagal memuat data: ' + error + '</div></div>');
            }
        });
    }

    // Save payment via AJAX
    $(document).on('submit', '#form-save-dekos', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = $('#btn-save-dekos');
        submitBtn.prop('disabled', true).html('<span class="fa fa-spinner fa-spin"></span> Menyimpan...');
        
        $.ajax({
            type: 'POST',
            url: 'ajax/save_dekos.php',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                submitBtn.prop('disabled', false).html('<span class="fa fa-check"></span> Simpan');
                if (response.status === 'success') {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert(response.message);
                    }
                    
                    // Reload the entire detail view so limits are re-checked, lunas status is updated
                    loadDekosDetail();
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                submitBtn.prop('disabled', false).html('<span class="fa fa-check"></span> Simpan');
                alert('Terjadi kesalahan saat menyimpan data: ' + error);
            }
        });
    });
    
    // Delete payment via AJAX
    $(document).on('click', '.btn-hapus-dekos', function() {
        var id = $(this).data('id');
        var confirmMsg = 'Apakah Anda yakin ingin menghapus data pembayaran ini?';
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi',
                text: confirmMsg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    executeDelete(id);
                }
            });
        } else {
            if (confirm(confirmMsg)) {
                executeDelete(id);
            }
        }
    });
    
    function executeDelete(id) {
        $.ajax({
            type: 'POST',
            url: 'ajax/del_dekos.php',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert(response.message);
                    }
                    loadDekosDetail();
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    } else {
                        alert(response.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat menghapus data: ' + error);
            }
        });
    }
});
</script>