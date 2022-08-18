<?php

//session_start();
$_SESSION = [];
session_destroy();
session_unset();
echo '<script language="javascript"> document.location="index.php";</script>';

?>
<!-- Akhir -->