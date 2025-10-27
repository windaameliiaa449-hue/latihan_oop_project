<?php
// File: index.php (Telah diperbaiki)
require_once 'Mahasiswa.php';
require_once 'Dosen.php';
require_once 'Staff.php';
require_once 'Login.php'; // Pastikan Login juga dimuat jika digunakan di instanceof

// ✅ PINDAHKAN FUNCTION KE SINI (SEBELUM DIPANGGIL)
function tampilkanInfoUser(User $user)
{
    echo "Polymorphism: " . $user->getUsername() . " memiliki peran sebagai " . $user->getRole();

    // Jika objek adalah Staff, tampilkan departemen juga
    if ($user instanceof Staff) {
        echo " (Departemen: " . $user->getDepartemen() . ")";
    }
    echo "<br>";
}

// KODE PRAKTIKUM
// PERBAIKAN: Mengganti 'mahasiswaa' menjadi 'Mahasiswa' (Nama Kelas yang benar)
// PERBAIKAN: Menggunakan variabel $mahasiswa (huruf kecil) secara konsisten
$mahasiswa = new Mahasiswa('Budi');
$dosen = new Dosen('Dr. Winda'); // Jika Dosen diubah untuk menerima 1 argumen

echo "<h2>Info User:</h2>";
// PERBAIKAN: Menggunakan variabel '$mahasiswa' dan '$dosen' yang benar
echo $mahasiswa->getUsername() . " adalah seorang " . $mahasiswa->getRole() . "<br>";
echo $dosen->getUsername() . " adalah seorang " . $dosen->getRole() . "<br>";

echo "<hr>";

// Demonstrasi Polymorphism (PRAKTIKUM)
echo "<h2>Demonstrasi Polymorphism:</h2>";
// PERBAIKAN: Menggunakan variabel '$mahasiswa' yang benar
tampilkanInfoUser($mahasiswa);
tampilkanInfoUser($dosen);

echo "<hr>";

// Demonstrasi Interface (PRAKTIKUM)
echo "<h2>Demonstrasi Interface:</h2>";
$dosen->kirimNotifikasi("Jadwal kuliah besok dibatalkan."); // Memanggil kirimNotifikasi

echo "<hr>";

// ✅ LATIHAN 3: POLYMORPHISM LEBIH KOMPLEKS
echo "<h2>Latihan 3: Polymorphism Lebih Kompleks</h2>";

// Buat array berisi beberapa objek
$objects = [
    // PERBAIKAN: Menggunakan nama Kelas 'Mahasiswa' yang benar (M kapital)
    new Mahasiswa('Budi'),
    new Dosen('Dr. Winda'),
    // Staff membutuhkan dua argumen
    new Staff('Ahmad', 'IT Support'),
    new Mahasiswa('Sari'),
    new Dosen('Prof. Joko'),
    new Staff('Dewi', 'Administrasi')
];

// Loop array dan panggil tampilkanInfoUser() untuk masing-masing
foreach ($objects as $obj) {
    tampilkanInfoUser($obj);

    // Jika objek mengimplementasikan Login, panggil login()
    if ($obj instanceof Login) {
        echo "Testing login: ";
        $obj->login($obj->getUsername(), "1234"); // Password benar

        echo "Testing login dengan password salah: ";
        $obj->login($obj->getUsername(), "wrong"); // Password salah
    }

    echo "---<br>";
}

// ✅ Tampilkan info staff terpisah
echo "<h2>Info Staff:</h2>";
$staff = new Staff('Ahmad', 'IT Support');
echo $staff->getUsername() . " adalah seorang " . $staff->getRole() .
    " di departemen " . $staff->getDepartemen() . "<br>";
