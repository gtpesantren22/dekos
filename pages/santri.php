<?php

$santri =  query("SELECT * FROM tb_santri ORDER by nis ASC");
?>
<section class="content-header">
    <h1>
        Data Tables
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
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Seluruh Santri</h3>
                    <a href="index.php?link=pages/add" type="button" class="btn btn-success pull-right"><span class="fa fa-plus-circle">
                        </span>
                        Tambah Data</a>
                    <a href="pages/excel2.php" target="_blank" type="button" class="btn btn-warning pull-right"><span class="fa fa-download">
                        </span>
                        Download Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Kamar</th>
                                    <th>Tmp Kos</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($santri as $r) :
                                    $t = array("", "Ny. Jamilah", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Naily", "Ny. Lathifah",);
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $r["nis"]; ?> </td>
                                        <td><?= $r["nama"]; ?> </td>
                                        <td><?= $r["k_formal"]; ?> <?= $r["t_formal"]; ?> / <?= $r["k_madin"]; ?>
                                            <?= $r["r_madin"]; ?> </td>
                                        <td><?= $r["komplek"]; ?> / <?= $r["kamar"]; ?> </td>
                                        <td><?= $t[$r["t_kos"]]; ?> </td>
                                        <td><?php $st = $r["stts"];
                                            $ps = explode("-", $st);
                                            if ($ps[0] == 1) {
                                                echo "<span class='label label-default'>Ust/Usdz</span>";
                                                echo " ";
                                            }
                                            if ($ps[1] == 2) {
                                                echo "<span class='label label-primary'>Mhs/i</span>";
                                                echo " ";
                                            }
                                            if ($ps[2] == 3) {
                                                echo "<span class='label label-success'>Sdr/i</span>";
                                                echo " ";
                                            }
                                            if ($ps[3] == 4) {
                                                echo "<span class='label label-info'>Kls 6</span>";
                                                echo " ";
                                            }
                                            if ($ps[4] == 5) {
                                                echo "<span class='label label-warning'>Baru</span>";
                                                echo " ";
                                            }
                                            if ($ps[5] == 6) {
                                                echo "<span class='label label-danger'>Lama</span>";
                                                echo " ";
                                            }
                                            if ($ps[6] == 7) {
                                                echo "<span class='label label-primary'>Peng. Wilyah</span>";
                                                echo " ";
                                            }
                                            if ($ps[7] == 8) {
                                                echo "<span class='label label-default'>Putra</span>";
                                                echo " ";
                                            }
                                            if ($ps[8] == 9) {
                                                echo "<span class='label label-info'>Putri</span>";
                                            }
                                            ?></td>
                                        <td>
                                            <!--<a href="<?= 'index.php?link=pages/e_tahapan&id=' . $r["nis"]; ?> "><button class="btn btn-xs btn-warning" type="submit"><span class="fa fa-edit"></span> Edit</button>-->
                                            <!--    <a href="<?= 'index.php?link=pages/e_tahapan2&id=' . $r["nis"]; ?> "><button class="btn btn-xs btn-primary" type="submit"><span class="fa fa-pencil"></span> Edit2</button>-->
                                        </td>
                                    </tr>

                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
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
</script>