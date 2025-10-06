<?php
require_once "User.php";
require_once "Login.php";

class Dosen extends User implements Login
{
    private $nidn;

    public function __construct($nama, $nidn)
    {
        parent::__construct($nama);
        $this->nidn = $nidn;
    }

    public function getRole()
    {
        return "Dosen";
    }

    public function tampilkanInfoUser()
    {
        echo "Nama: {$this->nama}<br>";
        echo "NIDN : {$this->nidn}<br>";
        echo "Role: {$this->getRole()}<br>";
    }

    public function login($username, $password)
    {
        if ($password == "1234") {
            echo "Login berhasil untuk Dosen {$this->nama}<br>";
        } else {
            echo "Login gagal untuk Dosen {$this->nama}<br>";
            
        }
        echo "<hr>";
    }
}
