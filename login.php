<?php
session_start();
require_once "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek di kedua tabel (admin dan user)
    $sql = "SELECT 'admin' as role, Username, Password FROM admin WHERE Username = ?
            UNION ALL
            SELECT 'user' as role, Username, Password FROM user WHERE Username = ?";

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Cek password (plain text atau hash)
            if ($user['Password'] === $password || password_verify($password, $user['Password'])) {
                $_SESSION['login'] = true;
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['Username'];

                // Redirect sesuai role
                header("Location: " . ($user['role'] == 'admin' ? 'dashboard_admin.php' : 'view.php'));
                exit;
            } else {
                $error = "Username atau Password Salah!";
            }
        } else {
            $error = "Username atau Password Salah!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Terjadi kesalahan dalam query!";
    }
}
?>
<!-- session_start();
require_once "koneksi.php";

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role']; // diambil dari form (select box)

    // Tentukan table berdasarkan role
    $table = ($role == 'admin') ? 'admin' : 'user';

    // Query cek user
    $sql    = "SELECT * FROM $table WHERE Username = ?";
    $stmt   = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Cek password (harus sesuai huruf besar: 'Password')
            if (isset($user['Password']) && password_verify($password, $user['Password'])) {
                $_SESSION['login']    = true;
                $_SESSION['role']     = $user['role'];      // dari kolom di DB
                $_SESSION['username'] = $user['Username'];  // juga dari DB

                // Redirect sesuai role (tetap pakai data input)
                header("Location: " . ($role == 'admin' ? 'dashboard_admin.php' : 'view.php'));
                exit;
            } else {
                $error = "Username atau Password Salah!";
            }
        } else {
            $error = "Username atau Password Salah!";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Terjadi kesalahan dalam query!";
    }
}
?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
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
        <div class="login-container">
            <div class="login-header">
                <h2>LOGIN</h2>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <!-- <input type="hidden" name="role" id="selectedRole" value="admin"> -->
                <div class="mb-3">
                    <label class="form-label"></label>
                    <select name="role" class="form-select btn btn-secondary">
                        <option class="btn btn-secondary" value="user">User</option>
                        <option class="btn btn-secondary" value="admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-login btn-primary">Login</button>
                <div class="text-center mt-3">
                    Belum punya akun? <a href="register.php">Daftar disini</a>
                </div>
            </form>
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
<!-- <div class="role-selector">
    <button type="button" class="role-btn active" data-role="admin">Admin</button>
    <button type="button" class="role-btn active" data-role="user">User</button>
</div> -->

<!-- if (isset($_POST['login'])) {
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];




//Query untk cek Akun user
$sql = "SELECT * FROM $table WHERE username = ?";

if (mysqli_num_rows($result) > 0) {
$user = mysqli_fetch_assoc($result);


header("Location: " . ($role == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
} else {
$error = "Username atau Password Salah!";
}
} else {
$error = "Username atau Password Salah!";
}
mysqli_stmt_close($stmt);
}

//Script untk toogle role
document.querySelectorAll('.role-btn').forEach(btn => {
btn.addEventListener('click', function() {
document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
this.classList.add('active');
document.getElementById('selectedRole').value = this.dataset.role;
});
}); -->