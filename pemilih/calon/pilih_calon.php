require_once 'Pemilih.php';

if (isset($_GET['kode'])) {
    $id_calon = $_GET['kode'];

    // Menginisialisasi objek Pemilih
    $pemilih = new Pemilih();

    // Memanggil fungsi vote
    $pemilih->vote($id_calon);
}
