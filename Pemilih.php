<?php
require_once 'inc/koneksi.php';

class Pemilih extends DBConnection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function tambahPemilih($nama_pengguna, $username)
{
    if (isset($_POST['Simpan'])) {
        $pass_acak = mt_rand(1000, 9999);
        $sql_simpan = "INSERT INTO tb_pengguna (nama_pengguna, username, password, level, status, jenis) VALUES (
            '".$nama_pengguna."',
            '".$username."',
            '".$pass_acak ."',
            'Pemilih',
            '1',
            'PST')";
        $query_simpan = $this->query($sql_simpan);
        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil',text: '',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = 'index.php?page=data-pemilih';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal',text: '',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = 'index.php?page=add-pemilih';
                }
            })</script>";
            echo "Error: " . $this->connection->error; // Menampilkan pesan error MySQL
        }
    }
}





    public function editPemilih()
    {
        if (isset($_POST['Ubah'])) {
            $sql_ubah = "UPDATE tb_pengguna SET
                nama_pengguna='".$_POST['nama_pengguna']."',
                username='".$_POST['username']."',
                password='".$_POST['password']."'
                WHERE id_pengguna='".$_POST['id_pengguna']."'";
            $query_ubah = mysqli_query($this->connection, $sql_ubah);
            mysqli_close($this->connection);

            if ($query_ubah) {
                echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=data-pemilih';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Ubah Data Gagal',text: '',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=data-pemilih';
                    }
                })</script>";
            }
        }
    }

    public function hapusPemilih($id_pengguna)
    {
        if (isset($_GET['kode'])) {
            $sql_hapus = "DELETE FROM tb_pengguna WHERE id_pengguna='".$_GET['kode']."'";
            $query_hapus = mysqli_query($this->connection, $sql_hapus);

            if ($query_hapus) {
                echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=data-pemilih';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=data-pemilih';
                    }
                })</script>";
            }
        }
    }
    public function vote($id_calon)
{
    $pemilihId = $_SESSION["ses_id"];

    // Periksa apakah pemilih sudah melakukan vote sebelumnya
    $sql_cek_vote = "SELECT * FROM tb_vote WHERE id_pemilih = '" . $pemilihId . "'";
    $query_cek_vote = $this->connection->query($sql_cek_vote);

    if ($query_cek_vote->num_rows > 0) {
        // Jika pemilih sudah melakukan vote, tampilkan pesan error
        echo "<script>
            Swal.fire({title: 'Anda Sudah Melakukan Vote', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=PsSQAdT';
                }
            })</script>";
    } else {
        // Jika pemilih belum melakukan vote, simpan data vote dan ubah status pemilih
        $sql_simpan_vote = "INSERT INTO tb_vote (id_calon, id_pemilih) VALUES (
            '" . $id_calon . "',
            '" . $pemilihId . "')";
        $sql_ubah_status = "UPDATE tb_pengguna SET status = '0' WHERE id_pengguna = '" . $pemilihId . "'";

        // Eksekusi query menggunakan koneksi dari DBConnection
        if ($this->connection->query($sql_simpan_vote) && $this->connection->query($sql_ubah_status)) {
            echo "<script>
                Swal.fire({title: 'Anda Berhasil Memilih', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=PsSQAdT';
                    }
                })</script>";
        } else {
            echo "<script>
                Swal.fire({title: 'Gagal Memilih', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=PsSQAdT';
                    }
                })</script>";
        }
    }
}

}
?>
