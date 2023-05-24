<?php
    
        require_once 'Pemilih.php';
        
        if (isset($_GET['kode'])) {
            $id_calon = $_GET['kode'];
        
            // Menginisialisasi objek Calon
            $pemilih = new Pemilih();
        
            // Memanggil fungsi hapusCalon
            $pemilih->hapusPemilih($id_pengguna);
        }
        ?>

