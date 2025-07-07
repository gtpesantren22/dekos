<?php

$tahapan =  query("SELECT * FROM tahapan ORDER by nama ASC");
?>
<section class="content-header">
    <h1>
        Data Tables
        <small>advanced tables</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Data</a></li>
        <li><a href="#">Data</a></li>
        <li class="active">Tahapan Syahriah</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Tahapan Syahriah</h3>
                    <a href="#" type="button" data-toggle="modal" class="btn btn-success pull-right"
                        data-target="#tambah"><span class="fa fa-plus-circle"> </span>
                        Tambah Data</a></a>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1_bst" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bulan</th>
                                <th>Status</th>
                                <th>Nominal</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tahapan as $r) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $r["nama"]; ?> </td>
                                <td><?= $r["bulan"]; ?> </td>
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
                                        }
                                        if ($ps[7] == 8) {
                                            echo "<span class='label label-default'>Putra</span>";
                                            echo " ";
                                        }
                                        if ($ps[8] == 9) {
                                            echo "<span class='label label-info'>Putri</span>";
                                        }
                                        ?></td>
                                <td><?= rupiah($r["nominal"]); ?> </td>
                                <td><?= $r["tahun"]; ?> </td>
                                <td>
                                    <button type="" name="edit" class="btn btn-warning btn-xs" href="#myModal"
                                        id="custId" data-toggle="modal" data-id="<?php echo $r['id']; ?>"><span
                                            class="fa fa-edit"></span></button>
                                    <button type="" name="hapus" class="btn btn-danger btn-xs" href="#hapus" id="custId"
                                        data-toggle="modal" data-id="<?php echo $r['id']; ?>"><span
                                            class="fa fa-close"></span></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>    
                    </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Data Tahapan</h4>
            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Hapus-->
<div class="modal fade" id="hapus" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="tambah" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data Tahapan</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="action_tahapan.php?aksi=tambah" method="post">
                    <div class="form-group">
                        <label>Tahapan</label>
                        <select name="nama" id="" class="form-control" required>
                            <option value=""> -- Pilih -- </option>
                            <option value="Tahap 1"> Tahap 1 </option>
                            <option value="Tahap 2"> Tahap 2 </option>
                            <option value="Tahap 3"> Tahap 3 </option>
                            <option value="Tahap 4"> Tahap 4 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" id="" class="form-control" required>
                            <option value=""> -- Pilih -- </option>
                            <option value="July - September"> July - September </option>
                            <option value="Oktober - Desember"> Oktober - Desember </option>
                            <option value="Januari - Maret"> Januari - Maret </option>
                            <option value="April - Juni"> April - Juni </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <table border="0">
                            <tr>
                                <td>
                                    <input type="checkbox" name="usd" value="1">
                                </td>
                                <td rowspan="3">&nbsp;</td>
                                <td>Ustad/Ustadzah</td>
                                <td rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    <input type="checkbox" name="mhs" value="2">
                                </td>
                                <td rowspan="3">&nbsp;</td>
                                <td>Mahasiswa/i</td>
                                <td>
                                    <input type="checkbox" name="sdr" value="3">
                                </td>
                                <td rowspan="3">&nbsp;</td>
                                <td>Bersaudara/i</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="kls6" value="4">
                                </td>
                                <td>Kelas 6</td>
                                <td>
                                    <input type="checkbox" name="br" value="5">
                                </td>
                                <td>Santi Baru</td>
                                <td>
                                    <input type="checkbox" name="pa" value="8">
                                </td>
                                <td>Putra</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="lm" value="6">
                                </td>
                                <td>Santi Lama</td>
                                <td>
                                    <input type="checkbox" name="pwl" value="7">
                                </td>
                                <td>Pengurus Wilayah</td>
                                <td>
                                    <input type="checkbox" name="pi" value="9">
                                </td>
                                <td>Putri</td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" id="rupiah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="tahun" id="" class="form-control" required>
                            <option value="">-- Pilih Tahun --</option>
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
                        <button type="submit" name="tambah" class="btn btn-success"><span class="fa fa-check"> </span>
                            Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close">
                            </span> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>