>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Bendahara</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>Bendahara</b>App</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">by : Rizal Asayadi Mochtar</p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" name="daftar" class="btn btn-primary btn-block btn-flat">Daftar !</button>
                    </div><!-- /.col -->
                </div>
                <hr>
                <p class="login-box-msg">Jika sudah ada Silahkan. <a href="login.php">Login !</a></p>
            </form>


        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

</html>

<?php

require 'function.php';

if (isset($_POST['daftar'])) {
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, strtoupper($_POST['nama'])));
    $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
    $pass = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
    $level = 'operator';
    $password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username  = '$username' ");
    $cek = mysqli_num_rows($sql);
    if ($cek >= 1) {
        echo "
        <script>
            alert('Maaf. Username sudah terpakai');
            window.location = 'register.php';
        </script>
        ";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama', '$username', '$password', '$level', 'T') ");
        if ($sql) {
            echo "
        <script>
            alert('Anda berhasil mendaftar. Selanjutnya silahkan hubungi admin untuk mengaktifkan akun anda');
            window.location = 'login.php';
        </script>
        ";
        }
    }
}

?>