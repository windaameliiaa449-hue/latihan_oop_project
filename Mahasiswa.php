<?php
require_once "User.php";
require_once "Login.php";

class Mahasiswa extends User implements Login
{
    private $nim;

    public function __construct($nama, $nim)
    {
        parent::__construct($nama);
        $this->nim = $nim;
    }

    public function getRole()
    {
        return "Mahasiswa";
    }

    public function tampilkanInfoUser()
    {
        echo "Nama: {$this->nama}<br>";
        echo "NIM : {$this->nim}<br>";
        echo "Role: {$this->getRole()}<br>";
    }

    public function login($username, $password)
    {
        if ($password == "1234") {
            echo "Login berhasil untuk Mahasiswa {$this->nama}<br>";
        } else {
            echo "Login gagal untuk Mahasiswa {$this->nama}<br>";
           
        }
         echo "<hr>";
    }
}
