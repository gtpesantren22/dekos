<?php
//include('dbconnected.php');
include('function.php');

if ($_POST['rowid']) {
	$id = $_POST['rowid'];
	// mengambil data berdasarkan id
	$sql = "SELECT * FROM tahapan WHERE id = $id";
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) { ?>

<form role="form" action="action_tahapan.php?aksi=hapus&id=<?= $id; ?>" method="post">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="modal-body btn-info">
        Apakah Anda yakin ingin menghapus data ini ?
    </div>
    <div class="modal-footer">
        <button type="submit" name="del" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
    </div>

    <?php
	}
	//mysql_close($host);
		?>
</form>
<?php
}
	?>
<!-- OK -->