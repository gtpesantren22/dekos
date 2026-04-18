<?php
include 'function.php';
$result = mysqli_query($conn, "SHOW COLUMNS FROM tb_santri");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . "\n";
}
?>
