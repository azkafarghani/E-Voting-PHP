<?php
session_start();

include_once 'inc/koneksi.php';

class Login extends DBConnection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser($username, $password)
    {
        $username = mysqli_real_escape_string($this->connection, $username);
        $password = mysqli_real_escape_string($this->connection, $password);

        $sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username' AND password='$password'";
        $query_login = mysqli_query($this->connection, $sql_login);
        $data_login = mysqli_fetch_array($query_login, MYSQLI_ASSOC);
        $jumlah_login = mysqli_num_rows($query_login);

        if ($jumlah_login == 1) {
            // Set session
            $_SESSION["ses_id"] = $data_login["id_pengguna"];
            $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
            $_SESSION["ses_username"] = $data_login["username"];
            $_SESSION["ses_password"] = $data_login["password"];
            $_SESSION["ses_level"] = $data_login["level"];
            $_SESSION["ses_status"] = $data_login["status"];
            $_SESSION["ses_jenis"] = $data_login["jenis"];

            // Redirect ke halaman index.php setelah login berhasil
            header("Location: index.php");
            exit();
        } else {
            $errorMessage = "Login Gagal";
        }
    }

    public function displayLoginPage()
    {
        // Cek status login
        if (isset($_SESSION['ses_username'])) {
            // Jika sudah login, redirect ke halaman index.php
            header("Location: index.php");
            exit();
        }

        if (isset($_POST['btnLogin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $this->loginUser($username, $password);
        }
        ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>E VOTING | Log in</title>
            <link rel="icon" href="dist/img/kotakipb.png">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
            <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
            <style>
                body {
                    height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: #f8f9fa;
                }

                .login-box {
                    width: 350px;
                }

                .login-logo img {
                    width: 170px;
                }
            </style>
        </head>

        <body class="hold-transition login-page">
            <div class="login-box">
                <div class="login-logo">
                    <img src="dist/img/kotakipb.png" alt="Logo" />
                    <br>
                    <a href="login.php">
                        <b>E Voting</b>
                    </a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Login</p>

                        <form action="" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning btn-block" name="btnLogin" title="Masuk Sistem">
                                        <b>Masuk</b>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.login-box -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
            <!-- Alert -->
            <script src="plugins/alert.js"></script>

        </body>

        </html>

        <?php
    }
}

$login = new Login();
$login->displayLoginPage();
?>
