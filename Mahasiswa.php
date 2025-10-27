<?php
// File: Mahasiswa.php (Definisi kelas yang benar)
require_once "User.php";
require_once "Login.php";

class Mahasiswa extends User implements Login {
    public function getRole() {
        return "Mahasiswa";
    }

    public function login($username, $password) {
        if ($password == "1234") {
            echo "Login berhasil untuk Mahasiswa {$this->username}<br>";
        } else {
            echo "Login gagal untuk Mahasiswa {$this->username} (Password: {$password})<br>";
        }
    }
}
?>