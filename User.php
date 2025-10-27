<?php
// File: User.php (Diasumsikan sebagai kelas induk)

abstract class User {
    protected $username;
    protected $role;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    // Metode ini harus diimplementasikan oleh kelas anak
    abstract public function getRole();
}
?>