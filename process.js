function search() {
	$("#loading").show(); // Tampilkan loadingnya

	$.ajax({
		type: "POST", // Method pengiriman data bisa dengan GET atau POST
		url: "search.php", // Isi dengan url/path file php yang dituju
		data: {
			nis: $("#nis").val()
		}, // data yang akan dikirim ke file proses
		dataType: "json",
		beforeSend: function (e) {
			if (e && e.overrideMimeType) {
				e.overrideMimeType("application/json;charset=UTF-8");
			}
		},
		success: function (response) { // Ketika proses pengiriman berhasil
			$("#loading").hide(); // Sembunyikan loadingnya

			if (response.status == "success") { // Jika isi dari array status adalah success
				$("#nama").val(response.nama); // set textbox dengan id nama
				$("#desa").val(response.desa); // set textbox dengan id jenis kelamin
				$("#kec").val(response.kec); // set textbox dengan id telepon
				$("#kab").val(response.kab); // set textbox dengan id alamat
				$("#k_formal").val(response.k_formal); // set textbox dengan id alamat
				$("#t_formal").val(response.t_formal); // set textbox dengan id alamat
				$("#kamar").val(response.kamar); // set textbox dengan id alamat
				$("#komplek").val(response.komplek); // set textbox dengan id alamat
			} else { // Jika isi dari array status adalah failed
				alert("Data Tidak Ditemukan");
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
			alert(xhr.responseText);
		}
	});
}

$(document).ready(function () {
	$("#loading").hide(); // Sembunyikan loadingnya

	$("#btn-search").click(function () { // Ketika user mengklik tombol Cari
		search(); // Panggil function search
	});

	$("#nis").keyup(function (event) { // Ketika user menekan tombol di keyboard
		if (event.keyCode == 13) { // Jika user menekan tombol ENTER
			search(); // Panggil function search
		}
	});
});