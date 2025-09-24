<?php
require_once "../config/Database.php";

class User
{
    private $db;
    // private $table = "users";

    public function __construct()
    {
        $con = $this->db = new Database();
    }

    // Method Login
    public function loginModel($username, $password, $role)
    {
        $sql = "SELECT * FROM users WHERE username = ? AND role = ? LIMIT 1";
        $stmt = mysqli_prepare($this->db->getConnection(), $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $role);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Password Hash
                if (password_verify($password, $user['password'])) {
                    return $user;
                } else {
                    return false; // Password salah
                }
            }
            // jika tidak ditemukan
            return false;
        }
        return false;
    }

    // Method Register
    public function register($data)
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->db->getConnection(), $sql);

        if ($stmt) {
            // 4 field: username, email, password, role -> 4 string types
            mysqli_stmt_bind_param($stmt, "sss", $data['username'], $data['email'], $hashedPassword);
            return mysqli_stmt_execute($stmt);
        }
        return false;
    }

    public function validateRegistration($data)
    {
        $username = isset($data['username']) ? trim($data['username']) : '';
        $email    = isset($data['email']) ? trim($data['email']) : '';
        $password = $data['password'] ?? '';
        $confirm  = $data['confirm_password'] ?? '';

        if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
            return ['valid' => false, 'message' => "Semua field harus diisi!"];
        }
        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['valid' => false, 'message' => "Format email tidak valid!"];
        }
        if ($password !== $confirm) {
            return ['valid' => false, 'message' => "Password dan Confirm Password tidak sesuai!"];
        }
        if (strlen($password) < 8) {
            return ['valid' => false, 'message' => "Password harus memiliki minimal 8 karakter!"];
        }
        return ['valid' => true, 'message' => ''];
    }

    // Method Cek Username
    public function isUsernameExists($username)
    {
        $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($this->db->getConnection(), $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_num_rows($result) > 0;
        } else {
            return false;
        }
    }

    // Method Cek Email
    public function isEmailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($this->db->getConnection(), $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_num_rows($result) > 0;
        } else {
            return false;
        }
    }

    // Method to redirect to login page with message
    public function redirectToLogin($message)
    {
        header("Location: ../view/login.php?success=" . urlencode($message));
        exit;
    }
}
