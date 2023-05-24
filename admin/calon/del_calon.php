<?php
require_once 'Calon.php';

if (isset($_GET['kode'])) {
    $id_calon = $_GET['kode'];

    // Menginisialisasi objek Calon
    $calon = new Calon();

    // Memanggil fungsi hapusCalon
    $calon->hapusCalon($id_calon);
}
?>

