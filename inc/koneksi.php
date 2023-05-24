<?php
class DBConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "e-voting1";
    public $connection;

    public function __construct() {
        $this->connection = $this->createConnection();
    }

    private function createConnection() {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        return $conn;
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }
}

$koneksi = new DBConnection();
$connection = $koneksi->connection;
