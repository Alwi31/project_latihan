<?php
// session_start();

$message = '';
$error = isset($error) ? $error : '';
$sukses = isset($sukses) ? $sukses : false;

// Perbaiki penamaan parameter GET (typo sebelumnya)
if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'logout_success':
            $message = "Anda telah berhasil logout.";
            break;
        case 'login_required':
            $error = "Silakan Login Terlebih Dahulu!";
            break;
        default:
            break;
    }
}

// Jika sudah login (cek session username), redirect langsung
if (isset($_SESSION['username'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
        header("Location: dashboard_admin.php");
        exit;
    } else {
        header("Location: ../index.php");
        exit;
    }
}

// Jika datang dari registrasi success
if (isset($_GET['success']) && !empty($_GET['success'])) {
    $message = $_GET['success'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/login.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2>LOGIN</h2>
            </div>
            <?php if ($message): ?>
                <div class="alert alert-success"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="../controller/AuthController.php?action=login" method="POST">
                <!-- <input type="hidden" name="action" id="selectedRole" value="login"> -->
                <div class="mb-3">
                    <label class="form-label"></label>
                    <select name="role" class="form-select btn btn-secondary">
                        <option class="btn btn-secondary" value="user">User</option>
                        <option class="btn btn-secondary" value="admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control input-line" id="username" name="username" placeholder="Masukkan Username/Email" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required autocomplete="new-password" minlength="8">
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-login btn-primary">Login</button>
                <div class="register-link">
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