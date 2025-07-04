<?php
session_start();
require 'function.php';

if (isset($_SESSION["bunda"])) {
    header("Location: index.php");
}

if (isset($_POST["log"])) {

    $username = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password"]));

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username  = '$username' AND aktif = 'Y' ");
    $tahun = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tahun ORDER BY nama DESC LIMIT 1 "));
    //$cek = mysqli_num_rows($sql);
    if (mysqli_num_rows($sql) == 0) {
        //jika salah
        echo '<script language="javascript">alert("Username / Password tidak ditemukan!"); document.location="login.php";</script>';
    } else {
        //jika benar
        $dt = mysqli_fetch_assoc($sql);
        $ps = $dt['password'];
        if (password_verify($password, $ps)) {
            $_SESSION['bunda'] = true;
            $_SESSION['id_user'] = $dt['id_user'];
            $_SESSION['nama'] = $dt['nama'];
            $_SESSION['level'] = $dt['level'];
            $_SESSION['tahun'] = $tahun['nama'];

            $host = $_SERVER['HTTP_HOST'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 1;
            $log = mysqli_query($conn, "insert into userlog(uid,username,userip,status) values('" . $dt['id_user'] . "','" . $username . "','$uip','$status')");
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

            echo '<script language="javascript"> document.location="index.php";</script>';
        }
    }
}

?>

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
            <a href="index.php"><b>Asayadi </b>Dekos</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">by : Rizal Asayadi Mochtar</p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="log" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div><!-- /.col -->
                </div>
                <hr>
                <p class="login-box-msg">Silahkan daftar dulu. <a href="register.php">Disini !</a></p>
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