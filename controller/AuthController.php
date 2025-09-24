<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../config/Database.php";
require_once "../model/User.php";


class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if (isset($_SESSION['username'])) {
            $this->redirectToDashboard($_SESSION['role']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $username = $this->sanitizeInput($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';
                $role     = $_POST['role'];

                $user = $this->userModel->loginModel($username, $password, $role);
                if ($user) {
                    // Set Session
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    $this->redirectToDashboard($user['role']);
                    exit;
                } else {
                    // tampilkan kembali form login dengan pesan error
                    $error = "Username atau Password Salah!";
                    include "../view/login.php";
                    exit;
                }
            } catch (Exception $e) {
                $error = "Terjadi kesalahan sistem: " . $e->getMessage();
                include "../view/login.php";
                exit;
            }
        } else {
            include "../view/login.php";
        }
    }

    public function register()
    {
        if ($_POST) {
            // Validasi Input
            $validation = $this->userModel->validateRegistration($_POST);
            if (!$validation['valid']) {
                $this->redirectWithError($validation['message']);
                return;
            }

            // Chechk Duplicate di Model
            if ($this->userModel->isUsernameExists($_POST['username'])) {
                $this->redirectWithError("Username sudah terdaftar!");
                return;
            }

            // Database Operation di Model
            $result = $this->userModel->register($_POST);
            if ($result) {
                $this->redirectWithSuccess("Registrasi berhasil! Silakan login.");
            } else {
                $this->redirectWithError("Registrasi gagal! Silakan coba lagi.");
            }
        } else {
            include "../view/register.php";
        }

        // if (isset($_SESSION['username'])) {
        //     $this->redirectToDashboard($_SESSION['role']);
        //     exit;
        // }

        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     $this->userModel->register($_POST);
        // } else {
        //     include "../view/login.php";
        // }
    }


    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../view/login.php");
        exit;
    }

    private function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    private function redirectWithError($message)
    {
        header("Location: ../view/register.php?error=" . urlencode($message));
        exit;
    }

    private function redirectWithSuccess($message)
    {
        header("Location: ../view/login.php?success=" . urlencode($message));
        exit;
    }


    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'admin':
                // admin dashboard ada di folder view
                header("Location: ../view/dashboard_admin.php");
                exit;
                break;
            case 'user':
                // arahkan ke root index
                header("Location: ../view/show.php");
                exit;
                break;
            default:
                header("Location: ../view/login.php");
                exit;
                break;
        }
    }
}

// Routing berdasarkan action
// $action = $_GET['action'] ?? '';
$auth = new AuthController();
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $auth->login();
            break;
        case 'register':
            $auth->register();
            break;
        case 'logout':
            $auth->logout();
            break;
        default:
            header("Location: ../view/login.php");
            break;
    }
} else {
    $auth->login();
}
