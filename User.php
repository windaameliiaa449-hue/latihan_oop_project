<?php
class User
{
    protected $nama;

    public function __construct($nama)
    {
        $this->nama = $nama;
    }

    public function getRole()
    {
        return "User";
    }

    public function tampilkanInfoUser()
    {
        echo "Nama: {$this->nama}<br>";
        echo "Role: {$this->getRole()}<br><br>";
        echo "<hr";
    }
}
