<?php
//include('dbconnected.php');
include('function.php');

//$id = $_GET["id"];
$id = $_GET["id"];
if (del_dekos($id) > 0) {
    echo "
        <script>
            document.location.href = 'index.php?link=pages/dekos/dekos';
        </script>    
";
} else {
    echo "<script>
            window.location.href = 'index.php?link=pages/dekos/dekos';
        </script>";
}

?>
<!-- OK -->