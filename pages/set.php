<?php
require 'function.php';
if (!empty($_FILES)) {
    // Validating SQL file type by extensions
    if (!in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Invalid File Type"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {}
    }
}

function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';

    if (file_exists($filePath)) {
        $lines = file($filePath);

        foreach ($lines as $line) {

            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }

            $sql .= $line;

            if (substr(trim($line), -1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach

        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
        exec('rm ' . $filePath);
    } // end if file exists

    return $response;
}

?>
<section class="content-header">
    <h1><span class="fa fa-gears"> </span>
        Setting Database
        <small>Preview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <?php
        if (!empty($response)) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable response <?php echo $response["type"]; ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4> <i class="icon fa fa-check"></i> Restore Database Sukses!</h4>
                Database sudah diperbarui. Silahkan cek kembali dikhawatirkan ada kesalahan Input data.
            </div>
        </div>
        <?php
        }
        ?>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <center>Backup Database</center>
                    </h3>
                </div>
                <div class="box-body">
                    <center>Download Database</center>
                    <br>
                    <h4><label for="">Tgl : <?= date("d F Y") ?></label></h4>
                    <a href="index.php?link=pages/backup"><button class="btn btn-success btn-block"><span
                                class="fa fa-download"></span>
                            Download</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <form method="post" action="" enctype="multipart/form-data" id="frm-restore">
                    <div class="box-header">
                        <h3 class="box-title">
                            <center>Restore Database</center>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Input Database</label>
                            <input type="file" class="form-control input-file" name="backup_file" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-warning btn-block" name="restore"><span
                                    class="fa fa-cloud-upload"></span>
                                Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>