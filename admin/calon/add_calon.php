<?php

require_once 'Calon.php'
?>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No urut</label>
				<div class="col-sm-6">
					<input type="number" class="form-control" id="id_calon" name="id_calon" placeholder="Nomor Urut" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Kandidat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_calon" name="nama_calon" placeholder="Nama Calon">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Foto Kandidat</label>
				<div class="col-sm-6">
					<input type="file" id="foto_calon" name="foto_calon">
					<p class="help-block">
						<font color="red">"Format file Jpg"</font>
					</p>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Keterangan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-calon" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    $id_calon = $_POST['id_calon'];
    $nama_calon = $_POST['nama_calon'];
    $foto_calon = $_FILES['foto_calon']['name'];
    $keterangan = $_POST['keterangan'];

    // Menginisialisasi objek Calon
    $calon = new Calon();

    // Memanggil fungsi tambahCalon
    $calon->tambahCalon($id_calon, $nama_calon, $foto_calon, $keterangan);
}
?>
