<?php
require_once "Mahasiswa.php";
require_once "Dosen.php";
require_once "Staff.php";

$users = [
    new Mahasiswa("WindaAmelia", "2311700040"),
    new Dosen("Budi", "987654"),
    new Staff("Citra", "Keuangan")
];

foreach ($users as $user) {
    $user->tampilkanInfoUser();

    if ($user instanceof Login) {
        $user->login("username", "1234");
    }
}
