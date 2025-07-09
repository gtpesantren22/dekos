<?php

$setor = mysqli_query($conn, "SELECT a.t_kos, COUNT(*) as total, b.nama, 
                                    COUNT(CASE WHEN a.ket = 0 THEN 1 END) bayar,
                                    COUNT(CASE WHEN a.ket = 1 THEN 1 END) ustd,
                                    COUNT(CASE WHEN a.ket = 2 THEN 1 END) khaddam,
                                    COUNT(CASE WHEN a.ket = 3 THEN 1 END) gratis,
                                    COUNT(CASE WHEN a.ket = 4 THEN 1 END) mhs 
                                    FROM tb_santri a JOIN tempat b ON a.t_kos=b.kd_tmp WHERE a.aktif = 'Y' GROUP BY a.t_kos");

$bl = array("-", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT a.t_kos, COUNT(*) as total, 
                                    COUNT(CASE WHEN a.ket = 0 THEN 1 END) bayar,
                                    COUNT(CASE WHEN a.ket = 1 THEN 1 END) ustd,
                                    COUNT(CASE WHEN a.ket = 2 THEN 1 END) khaddam,
                                    COUNT(CASE WHEN a.ket = 3 THEN 1 END) gratis,
                                    COUNT(CASE WHEN a.ket = 4 THEN 1 END) mhs 
                                    FROM tb_santri a JOIN tempat b ON a.t_kos=b.kd_tmp WHERE a.aktif = 'Y' "));
?>
<section class="content-header">
    <h1><span class="fa fa-cutlery"> </span>
        Data Kunci Jumlah Santri Dekos
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

        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Buat Data Baru</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="" id="form-kunci">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="bulan" id="" class="form-control" required>
                                        <option value=""> -- pilih bulan --</option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?= $i; ?>"><?= $bl[$i] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value=""> -- pilih tahun --</option>
                                        <?php
                                        $th = mysqli_query($conn, "SELECT * FROM tahun");
                                        while ($dth = mysqli_fetch_assoc($th)) { ?>
                                            <option value="<?= $dth['nama'] ?>"><?= $dth['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" name="buat_kunci" class="btn btn-primary"><i
                                            class="fa fa-check"></i> Buat</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tempat</th>
                                    <th>Santri Bayar</th>
                                    <th>Ust/Ustdz</th>
                                    <th>Gratis</th>
                                    <th>Khaddam</th>
                                    <th>Total</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($r = mysqli_fetch_assoc($setor)) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $r['nama'] ?></td>
                                        <td><?= $r['bayar'] ?></td>
                                        <td><?= $r['ustd'] ?></td>
                                        <td><?= $r['gratis'] ?></td>
                                        <td><?= $r['khaddam'] ?></td>
                                        <td><?= $r['total'] ?></td>
                                        <td><a href="<?= 'index.php?link=pages/kunci/add2&tks=' . $r['t_kos']; ?>"><button
                                                    class="btn btn-success btn-xs"><i class="fa fa-users"></i> Lihat
                                                    Santri</button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">TOTAL</th>
                                    <th><?= $total['bayar']; ?></th>
                                    <th><?= $total['ustd'] ?></th>
                                    <th><?= $total['gratis'] ?></th>
                                    <th><?= $total['khaddam'] ?></th>
                                    <th><?= $total['total'] ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
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
    $('#form-kunci').on('submit', function(e) {
        e.preventDefault();
        var data = $(this).serialize()
        $.ajax({
            type: 'POST',
            url: 'ajax/save_acts.php?to=add_kunci',
            data: data,
            dataType: 'json',
            success: function(data) {
                alert('Buat kunci berhasil')
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        })
    })
</script>