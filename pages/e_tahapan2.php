<?php
include('function.php');
$id = $_GET["id"];
$row = query("SELECT * FROM tb_santri WHERE nis = $id ")[0];
?>
        <body class="hold-transition skin-blue sidebar-mini">
            <!-- Content Wrapper. Contains page content -->
            <section class="content-header">
                <h1>
                    Edit Status dan Tempat Kos Santri
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
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Data Seluruh Santri</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input type="text" class="form-control" value="<?php echo $row['nis']; ?>" required disabled>
                                        <input type="hidden" name="nis" class="form-control" value="<?php echo $row['nis']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                                    </div>


                                    <div class="form-group">
                                        <label>Tempat dekos</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="t_kos" id="" class="form-control" required>
                                                    <?php
                                                    $ts = $row['t_kos'];
                                                    $tks = ["-", "Kantin", "Gus Zaini", "Ny. Farihah", "Ny. Zahro", "Ny. Sa'adah", "Ny. Mamjudah", "Ny. Nely", "Ny. Lathifah"];
                                                    ?>
                                                    <option value="<?= $ts; ?>"><?= $tks[$ts]; ?></option>
                                                    <option value="">---------------</option>
                                                    <option value="1"> Kantin </option>
                                                    <option value="2"> Gus Zaini </option>
                                                    <option value="3"> Ny. Farihah </option>
                                                    <option value="4"> Ny. Zahro </option>
                                                    <option value="5"> Ny. Sa'adah </option>
                                                    <option value="6"> Ny. Mamjudah</option>
                                                    <option value="7"> Ny. Nely</option>
                                                    <option value="8"> Ny. Lathifa</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="ket" id="" class="form-control" required>
                                                    <?php
                                                    $k = $row['ket'];
                                                    $kt = ["-", "Ust/Usdtz", "Khaddam", "Gratis", "Berhenti"];
                                                    ?>
                                                    <option value="<?= $k; ?>"><?= $kt[$k]; ?></option>
                                                    <option value="0">---------------</option>
                                                    <option value="1"> Ust/Usdtz </option>
                                                    <option value="2"> Khaddam </option>
                                                    <option value="3"> Gratis </option>
                                                    <option value="4"> Berhenti </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="update3" class="btn btn-warning"><span class="fa fa-check">
                                            </span> Update</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close">
                                            </span> Close</button>
                                    </div>
                                </form>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <!-- OK -->
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
        </body>

        </html>
        
<?php 

if (isset($_POST['update3'])) {
        $nis = $_POST["nis"];
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $t_kos = $_POST["t_kos"];
        $ket = $_POST["ket"];
        

        //Query
        $query = "UPDATE tb_santri SET nama = '$nama', t_kos = $t_kos, ket = $ket WHERE nis = '$nis' ";
        //mysqli_query($conn2, $query);

        //return mysqli_affected_rows($conn);

        
        if (mysqli_query($conn, $query)) {
            # credirect ke page index
            echo "
            <script>
                window.location.href = 'index.php?link=pages/santri';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Gagal Muhtarom !');
                window.location.href = 'index.php?link=pages/santri';
            </script>
            ";
        }
    }

?>