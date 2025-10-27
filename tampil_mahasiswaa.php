<?php
require_once 'Database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Daftar Mahasiswa Jurusan Teknik Informatika</h1>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody> <?php 
        try {
                    $pdo = new Database();
                    $jurusan = 'sistem informasi';
                    $mahasiswas = $pdo->getalljurusan($jurusan);
                    $mahasiswa2 = $pdo->getAllTable('mahasiswa');
                    if ($mahasiswa2) {
                        foreach ($mahasiswas as $mhs) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($mhs['nim']) . "</td>";
                            echo "<td>" . htmlspecialchars($mhs['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($mhs['jurusan']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data mahasiswa.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='3'>Error: " . $e->getMessage() . "</td></tr>";
                } ?></tbody>
    </table>
</body>

</html>