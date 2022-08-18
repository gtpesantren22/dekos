<?php
session_start();
if (!isset($_SESSION["bunda"])) {
    echo '<script language="javascript">alert("Silahkan login terlebih dahulu!"); document.location="login.php";</script>';
    exit;
}

$nama = $_SESSION['nama'];
$level = $_SESSION['level'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Dekosan Santri PPDWK</title>
    <script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
    <script src="process.js"></script> <!-- Load file process.js -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <!--<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
    <!-- <link rel="stylesheet" type="text/css" href="asset/bootstrap4/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="asset/swal2/sweetalert2.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->


    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>As</b>D</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Mari</b>Makan</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $nama; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?= $nama; ?>
                                        <small>Bendahara Putra</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="index.php?link=pages/logout" class="btn btn-default btn-flat">Sign
                                            out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $nama; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li><a href="index.php?link=pages/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Master Data</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?link=pages/santri">
                                    <i class="fas fa-ribbon"></i> <span> Data Santri</span>
                                </a></li>
                            <li><a href="index.php?link=pages/tahapan"><i class="fas fa-ribbon"></i> Data Tahapan</a>
                            </li>
                            <li><a href="index.php?link=pages/tahun/tahun"><i class="fas fa-ribbon"></i> Data
                                    Tahun Ajaran</a>
                            </li>
                            <li><a href="index.php?link=pages/akun/akun"><i class="fas fa-ribbon"></i> Data
                                    Akun Pengurus</a>
                            </li>
                            <li><a href="index.php?link=pages/tempat"><i class="fas fa-ribbon"></i> Data
                                    Tempat Dekos</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="index.php?link=pages/dekos/dekos"><i class="fa fa-list"></i> <span>Data Dekosan</span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cash-register"></i> <span> Setoran</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?link=pages/rekap/rekap_kos2"><i class="fas fa-ribbon"></i>
                                    Input Setoran</a></li>
                            <li><a href="index.php?link=pages/setor/setor"><i class="fas fa-ribbon"></i>
                                    Data Setoran</a></li>
                            <li><a href="index.php?link=pages/setor/cek_saldo"><i class="fas fa-ribbon"></i>
                                    Cek Saldo</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-search"></i> <span> Cek Data</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?link=pages/dekos/cek_kos"><i class="fas fa-ribbon"></i>
                                    Perkelas</a></li>
                            <li><a href="index.php?link=pages/dekos/cek_kos3"><i class="fas fa-ribbon"></i>
                                    Perdokosan</a></li>
                            <li><a href="index.php?link=pages/dekos/cek_kos2"><i class="fas fa-ribbon"></i>
                                    Semua Santri</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?link=pages/dekos/persen4"><i class="fa fa-percent"></i> <span>Persentase</span></a></li>
                    <li><a href="index.php?link=pages/kunci/data"><i class="fa fa-key"></i> <span>Data Jumlah Kunci</span></a></li>

                    <?php if ($level == 'admin') { ?>
                        <li>
                            <a href="index.php?link=pages/set">
                                <i class="fa fa-window-restore"></i> <span>Backup & Restore</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="header">LABELS</li>
                    <li><a href="index.php?link=pages/info/info"><i class="fa fa-exclamation-triangle text-green"></i>
                            <span>Peringatan</span></a>
                    </li>
                    <li><a href="index.php?link=pages/logout"><i class="fa fa-power-off text-red"></i>
                            <span>Logout</span></a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
            if (!empty($_GET['link'])) {
                include($_GET['link'] . '.php');
            } else {
                include('pages/home.php');
            }
            ?>
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; Bussiness Center SMK DWK 2020.</strong> All
            rights reserved.
        </footer>

    </div><!-- ./wrapper -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();
            //Date range picker
            $('#reservation').daterangepicker();
            //Date picker
            $('#datepic').datepicker();

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'e_tahapan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#hapus').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'del_tahapan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#t_formal").change(function() {
                var t_formal = $("#t_formal").val();
                $.ajax({
                    type: 'POST',
                    url: "ajax/get_kelas.php",
                    data: {
                        t_formal: t_formal
                    },
                    cache: false,
                    success: function(msg) {
                        $("#k_formal").html(msg);
                    }
                });
            });
        });
    </script>
    <script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
    <script src="process.js"></script> <!-- Load file process.js -->
    <script src="asset/swal2/sweetalert2.min.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <!--<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <script type="text/javascript">
        var rupiah = document.getElementById('rupiah');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $("#example1_bst").DataTable();
            $("#example2_bst").DataTable();
            $("#example3_bst").DataTable();
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
    <script>
        // function in berfungsi untuk memindahkan data kolom yang di klik menuju text box
        function masuk(txt, data) {
            document.getElementById('nis').value = data; // ini berfungsi mengisi value yang ber id textbox
            $("#tambah").modal('hide'); // ini berfungsi untuk menyembunyikan modal
        }
        $("#example1_bst").DataTable();
        $("#example2_bst").DataTable();
        $("#example3_bst").DataTable();
    </script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>



    <!-- page script -->
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            //-------------
            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [{
                        y: '2006',
                        a: 100,
                        b: 90
                    },
                    {
                        y: '2007',
                        a: 75,
                        b: 65
                    },
                    {
                        y: '2008',
                        a: 50,
                        b: 40
                    },
                    {
                        y: '2009',
                        a: 75,
                        b: 65
                    },
                    {
                        y: '2010',
                        a: 50,
                        b: 40
                    },
                    {
                        y: '2011',
                        a: 75,
                        b: 65
                    },
                    {
                        y: '2012',
                        a: 100,
                        b: 90
                    }
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['CPU', 'DISK'],
                hideHover: 'auto'
            });
        });
    </script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>

</body>

</html>