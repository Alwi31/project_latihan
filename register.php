<?php
session_start();
require_once "koneksi.php";

$sukses = $error = "";

if (isset($_POST['register'])) {
    $username           = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email              = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password           = $_POST['password'];
    $confirm_password   = $_POST['confirm_password'];

    // Validasi
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua field harus diisi!";
    } elseif ($password != $confirm_password) {
        $error = "Password Tidak Cocok!";
    } elseif (strlen($password) < 8) {
        $error = "Password harus minimal 8 karakter!";
    } else {
        // Cek Username/email Sudah Ada
        $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' OR email = '$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username atau email sudah terdaftar..!";
        } else {
            // Hash Password
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan ke Database
            $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($koneksi, $sql)) {
                $sukses = "Registrasi Berhasil, Silakan Login.";
                header("refresh:2;url=login.php");
            } else {
                $error = "Gagal Registrasi: " . mysqli_error($koneksi);
            }
        }
        $result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM user");
        $row    = mysqli_fetch_assoc($result);
        if ($row['total'] == 0) {
            $username   = "admin";
            $password   = "admin123"; //Passwod default
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($koneksi, "INSERT INTO user (username, password) VALUES ('$username', '$password')");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            background-color: #f8f9fa;
        }

        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: #343a40;
            font-weight: bold;
        }

        .btn.register {
            background-color: #6c757d;
            border: none;
            width: 100%;
            padding: 30px;
            font-weight: bold;
        }

        .btn.register:hover {
            background-color: #5a6268;
        }

        /* CSS Password Toggle */
        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #6c757d;
            font-size: 1.2rem;
        }

        .password-toggle:hover {
            color: #495057;
        }

        .form-control {
            padding-right: 40px;
        }

        .form-control::placeholder {
            color: #a0a0a0;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h2>REGISTER AKUN</h2>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($sukses && !isset($_SESSION['login'])): ?>
                <div class="alert alert-success"><?= $sukses ?></div>
            <?php endif; ?>

            <form action="register.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                        <i class="bi bi-eye-slash password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPassword')"></i>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-register btn-primary w-100">Register</button>
            </form>
            <div class="text-center mt-3">
                Sudah punya akun? <a href="login.php">Login Disini</a>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputId, toggleId) {
            const passwordField = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>

</html>