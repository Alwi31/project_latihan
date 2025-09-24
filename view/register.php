<?php
session_start();

$message = '';
$error   = '';
$success = '';

// Baca pesan error/success dari query string (controller mengirim ?error=.. atau ?success=..)
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
if (isset($_GET['success'])) {
    $success = $_GET['success'];
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
    <link rel="stylesheet" href="./assets/register.css">
</head>

<body>
    <div class="container">
        <div class="register-container">
            <div class="register-header">
                <h2>REGISTER</h2>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($message && !isset($_SESSION['login'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form action="../controller/AuthController.php?action=register" method="POST">
                <div class="mb-3">
                    <!-- <label for="form-label"></label>
                    <select name="role" class="form-select btn btn-secondary">
                        <option class="btn btn-secondary" value="user">User</option>
                        <option class="btn btn-secondary" value="admin">Admin</option>
                    </select> -->
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
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required autocomplete="new-password" minlength="8">
                        <i class="bi bi-eye-slash password-toggle" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required autocomplete="new-password" minlength="8">
                        <i class="bi bi-eye-slash password-toggle" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPassword')"></i>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-register btn-primary w-100">Register</button>
            </form>
            <div class="login-link">
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