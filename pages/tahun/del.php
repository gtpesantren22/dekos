<?php
//include('dbconnected.php');
include('function.php');

$id = $_GET["id"];
if (del_tahun($id) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/tahun/tahun';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/tahun/tahun';
        </script>";
}

?>
<!-- OK -->