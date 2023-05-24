<?php

require_once'inc/koneksi.php';

class Calon extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tambahCalon($id_calon, $nama_calon, $foto_calon, $keterangan)
    {
        $id_calon = mysqli_real_escape_string($this->connection, $id_calon);
        $nama_calon = mysqli_real_escape_string($this->connection, $nama_calon);
        $foto_calon = mysqli_real_escape_string($this->connection, $foto_calon);
        $keterangan = mysqli_real_escape_string($this->connection, $keterangan);

        // Pindahkan file foto_calon ke folder 'foto/'
        $sumber = @$_FILES['foto_calon']['tmp_name'];
        $target = 'foto/';
        $nama_file = @$_FILES['foto_calon']['name'];
        $pindah = move_uploaded_file($sumber, $target.$nama_file);

        if (!empty($sumber) && $pindah) {
            $sql_simpan = "INSERT INTO tb_calon (id_calon, nama_calon, foto_calon, keterangan) VALUES (
            '".$id_calon."',
            '".$nama_calon."',
            '".$nama_file."',
            '".$keterangan."')";
        } else {
            $sql_simpan = "INSERT INTO tb_calon (id_calon, nama_calon, keterangan) VALUES (
            '".$id_calon."',
            '".$nama_calon."',
            '".$keterangan."')";
        }

        $query_simpan = mysqli_query($this->connection, $sql_simpan);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = 'index.php?page=data-calon';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value){
                window.location = 'index.php?page=add-calon';
                }
            })</script>";
        }
    }

    public function hapusCalon($id_calon)
    {
        $id_calon = mysqli_real_escape_string($this->connection, $id_calon);

        $sql_cek = "SELECT * FROM tb_calon WHERE id_calon='".$id_calon."'";
        $query_cek = mysqli_query($this->connection, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

        $foto = $data_cek['foto_calon'];
        if (file_exists("foto/$foto")) {
            unlink("foto/$foto");
        }

        $sql_hapus = "DELETE FROM tb_calon WHERE id_calon='".$id_calon."'";
        $query_hapus = mysqli_query($this->connection, $sql_hapus);

        if ($query_hapus) {
            echo "<script>
            Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=data-calon';}})</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=data-calon';}})</script>";
        }
    }

    public function editCalon($id_calon, $nama_calon, $foto_calon, $keterangan)
    {
        $id_calon = mysqli_real_escape_string($this->connection, $id_calon);
        $nama_calon = mysqli_real_escape_string($this->connection, $nama_calon);
        $foto_calon = mysqli_real_escape_string($this->connection, $foto_calon);
        $keterangan = mysqli_real_escape_string($this->connection, $keterangan);

        $sql_cek = "SELECT * FROM tb_calon WHERE id_calon='".$id_calon."'";
        $query_cek = mysqli_query($this->connection, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

        $sumber = @$_FILES['foto_calon']['tmp_name'];
        $target = 'foto/';
        $nama_file = @$_FILES['foto_calon']['name'];
        $pindah = move_uploaded_file($sumber, $target.$nama_file);

        if (!empty($sumber) && $pindah) {
            $foto = $data_cek['foto_calon'];
            if (file_exists("foto/$foto")) {
                unlink("foto/$foto");
            }

            $sql_ubah = "UPDATE tb_calon SET
                nama_calon='".$nama_calon."',
                foto_calon='".$nama_file."',
                keterangan='".$keterangan."'
                WHERE id_calon='".$id_calon."'";
        } else {
            $sql_ubah = "UPDATE tb_calon SET
                nama_calon='".$nama_calon."',
                keterangan='".$keterangan."'
                WHERE id_calon='".$id_calon."'";
        }

        $query_ubah = mysqli_query($this->connection, $sql_ubah);

        if ($query_ubah) {
            echo "<script>
            Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=data-calon';}})</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=data-calon';}})</script>";
        }
    }
    public function tampilDataCalon()
    {
        $sql = "SELECT * FROM tb_calon";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['id_calon'] . "</td>";
                echo "<td>" . $data['nama_calon'] . "</td>";
                echo "<td align='center'><img src='foto/" . $data['foto_calon'] . "' width='150px' /></td>";
                echo "<td>" . $data['keterangan'] . "</td>";
                echo "<td>";
                echo "<a href='?page=edit-calon&kode=" . $data['id_calon'] . "' title='Ubah' class='btn btn-success btn-sm'><i class='fa fa-edit'></i></a>";
                echo "<a href='?page=del-calon&kode=" . $data['id_calon'] . "' onclick=\"return confirm('Apakah anda yakin hapus data ini ?')\" title='Hapus' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data calon</td></tr>";
        }
    }
}


?>