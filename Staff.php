<?php
// File: Staff.php (Definisi kelas yang benar)
require_once "User.php";
require_once "Login.php";
require_once "Notifikasi.php"; // Jika Staff juga harus bisa mengirim notifikasi

class Staff extends User implements Login {
    private $departemen;

    public function __construct($username, $departemen) {
        parent::__construct($username);
        $this->departemen = $departemen;
    }

    public function getRole() {
        return "Staff Administrasi";
    }

    public function getDepartemen() {
        return $this->departemen;
    }

    public function login($username, $password) {
        if ($password == "1234") {
            echo "Login berhasil untuk Staff {$this->username} ({$this->departemen})<br>";
        } else {
            echo "Login gagal untuk Staff {$this->username} (Password: {$password})<br>";
        }
    }
}
?>