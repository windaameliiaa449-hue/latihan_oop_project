<?php
require_once "User.php";

class Staff extends User
{
    private $departemen;

    public function __construct($nama, $departemen)
    {
        parent::__construct($nama);
        $this->departemen = $departemen;
    }

    public function getRole()
    {
        return "Staff";
    }

    public function tampilkanInfoUser()
    {
        echo "Nama: {$this->nama}<br>";
        echo "Departemen : {$this->departemen}<br>";
        echo "Role: {$this->getRole()}<br>";
        echo "<hr>";
    }
}
