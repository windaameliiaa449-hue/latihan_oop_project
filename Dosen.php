<?php
// File: Dosen.php (Disesuaikan)
require_once "User.php";
require_once "Login.php";
require_once "Notifikasi.php"; // Tambahkan Notifikasi

class Dosen extends User implements Login, Notifikasi // Implementasi Notifikasi
{
    private $nidn;

    // Perbaikan: Hapus $nidn dari __construct jika hanya dipanggil dengan $nama di index.php
    // Atau ubah index.php untuk memanggil dengan 2 argumen.
    public function __construct($nama) 
    {
        parent::__construct($nama);
        // $this->nidn = $nidn; // Dinonaktifkan agar sesuai dengan pemanggilan 1 argumen di index.php
    }

    public function getRole()
    {
        return "Dosen";
    }

    public function kirimNotifikasi($pesan) // Implementasi dari interface Notifikasi
    {
        echo "Notifikasi dikirim ke Dosen {$this->username}: **{$pesan}**<br>";
    }

    public function tampilkanInfoUser()
    {
        echo "Nama: {$this->username}<br>";
        echo "Role: {$this->getRole()}<br>";
    }

    public function login($username, $password)
    {
        if ($password == "1234") {
            echo "Login berhasil untuk Dosen {$this->username}<br>";
        } else {
            echo "Login gagal untuk Dosen {$this->username} (Password: {$password})<br>";
            
        }
        echo "<hr>";
    }
}
?>