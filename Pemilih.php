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
        $query_simpan = mysqli_query($this->connection, $sql_simpan);


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

    public function deletePemilih()
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
}
?>
