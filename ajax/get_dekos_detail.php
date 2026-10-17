<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../function.php";

$nis = isset($_POST['nis']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nis'])) : '';
$tahun = isset($_POST['tahun']) ? htmlspecialchars(mysqli_real_escape_string($conn, $_POST['tahun'])) : '';

if (empty($nis) || empty($tahun)) {
    echo '<div class="col-md-12"><div class="alert alert-warning">Pilih NIS Santri dan Tahun terlebih dahulu!</div></div>';
    exit;
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_santri WHERE nis = '$nis' "));
if (!$data) {
    echo '<div class="col-md-12"><div class="alert alert-danger">Santri dengan NIS <b>' . htmlspecialchars($nis) . '</b> tidak ditemukan!</div></div>';
    exit;
}

$tm = array("-", "Ny. Jamilah", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Naily Z.", "Ny. Lathifah");
$ket = array('Bayar', 'Ust/Usdtz', 'Khaddam', 'Gratis', 'Berhenti', 'Sakit');
?>
<div class="col-md-6">
    <div class="callout callout-success">
        <h4><span class="fa fa-bullhorn"></span> Info Santri</h4>
        <br>
        <table cellspacing="5" cellpadding="5">
            <tr>
                <th rowspan="6"><img src="" alt="" height="130px" width="100px"></th>
                <th style="padding: 3px 10px">NIS</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['nis'] != '' ? $data['nis'] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">Nama</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['nama'] != '' ? $data['nama'] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">Kelas</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['k_formal'] != '' ? $data['k_formal'] : '-') ?> <?= htmlspecialchars($data && $data['t_formal'] != '' ? $data['t_formal'] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">Alamat</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['desa'] != '' ? $data['desa'] : '-') ?> - <?= htmlspecialchars($data && $data['kec'] != '' ? $data['kec'] : '-') ?> - <?= htmlspecialchars($data && $data['kab'] != '' ? $data['kab'] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">Dekos</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['t_kos'] != '' ? $tm[$data['t_kos']] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">Ket</th>
                <th style="padding: 3px 10px">:</th>
                <th style="padding: 3px 10px"><?= htmlspecialchars($data && $data['ket'] != '' ? $ket[$data['ket']] : '-') ?></th>
            </tr>
            <tr>
                <th style="padding: 3px 10px">&nbsp;</th>
                <th style="padding: 3px 10px">&nbsp;</th>
                <th style="padding: 3px 10px">&nbsp;</th>
                <th style="padding: 3px 10px">&nbsp;</th>
            </tr>
        </table>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Form Input Pembayaran</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="form-save-dekos" method="post">
            <input type="hidden" name="nis" value="<?= htmlspecialchars($nis); ?>">
            <input type="hidden" name="thn" value="<?= htmlspecialchars($tahun); ?>">
            <input type="hidden" name="penerima" value="<?= htmlspecialchars($_SESSION['nama']); ?>">
            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Nominal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nominal" id="rupiah" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Bulan</label>
                    <div class="col-sm-5">
                        <select name="bln" id="" class="form-control" required>
                            <option value="">-- Pilih Bulan --</option>
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
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?= htmlspecialchars($tahun) ?>" readonly disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tgl" id="datepic" value="<?= date('m/d/Y') ?>" required autocomplete="off">
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" id="btn-save-dekos" name="save" class="btn btn-success pull-right"><span class="fa fa-check"></span> Simpan</button>
            </div>
        </form>
    </div><!-- /.box -->
</div>

<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Riwayat Pembayaran Tahun <?= htmlspecialchars($tahun) ?></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align: center; color: white; background-color: lightseagreen; font-size: 16px; vertical-align: middle;">
                                #
                            </th>
                            <th rowspan="2" style="text-align: center; color: white; background-color: lightseagreen; font-size: 16px; vertical-align: middle;">
                                Bulan
                            </th>
                            <th colspan="2" style="text-align: center; color: white; background-color: lightskyblue;">Bayar</th>
                            <th rowspan="2" style="text-align: center; color: white; background-color: lightsalmon; font-size: 16px; vertical-align: middle;">
                                Ket
                            </th>
                            <th rowspan="2" style="text-align: center; color: white; background-color: lightsalmon; font-size: 16px; vertical-align: middle;">
                                Waktu
                            </th>
                            <th rowspan="2" style="text-align: center; color: white; background-color: lightcoral; font-size: 16px; vertical-align: middle;">
                                Aksi
                            </th>
                        </tr>
                        <tr>
                            <th style="color: white; background-color: lightsteelblue; text-align: center;">Tgl. Bayar</th>
                            <th style="color: white; background-color: lightsteelblue; text-align: center;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody id="dekos-table-body">
                        <?php include "get_dekos_list.php"; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>