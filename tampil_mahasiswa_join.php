<?php
require_once 'Database.php';

try {
    $db = Database::getInstance();

    // === AMBIL DAFTAR JURUSAN ===
    $stmtJurusan = $db->query("SELECT * FROM jurusan ORDER BY nama_jurusan");
    $daftarJurusan = $stmtJurusan->fetchAll(PDO::FETCH_ASSOC);

    // === HANDLE UPDATE DATA ===
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $nimEdit = $_POST['nim'];
        $namaBaru = trim($_POST['nama_baru']);
        if (!empty($namaBaru)) {
            $stmtUpdate = $db->prepare("UPDATE mahasiswa SET nama = :nama WHERE nim = :nim");
            $stmtUpdate->bindValue(':nama', $namaBaru);
            $stmtUpdate->bindValue(':nim', $nimEdit);
            $stmtUpdate->execute();
        }
    }

    // === HANDLE FILTER DAN SORTING ===
    $jurusanFilter = $_GET['jurusan'] ?? '';
    $sortBy = $_GET['sort_by'] ?? 'nama';
    $sortOrder = $_GET['sort_order'] ?? 'ASC';

    // validasi input sort agar tidak bisa disisipi SQL injection
    $allowedColumns = ['nim', 'nama', 'nama_jurusan'];
    $allowedOrders = ['ASC', 'DESC'];
    if (!in_array($sortBy, $allowedColumns)) $sortBy = 'nama';
    if (!in_array($sortOrder, $allowedOrders)) $sortOrder = 'ASC';

    // === QUERY DATA MAHASISWA ===
    $sql = "SELECT DISTINCT m.nim, m.nama, j.nama_jurusan 
            FROM mahasiswa m 
            LEFT JOIN jurusan j ON m.jurusan = j.id";
    
    $params = [];

    // jika user memilih jurusan tertentu
    if (!empty($jurusanFilter) && is_numeric($jurusanFilter)) {
        $sql .= " WHERE m.jurusan = :jurusan";
        $params[':jurusan'] = $jurusanFilter;
    }

    // tambahkan sorting
    $sql .= " ORDER BY $sortBy $sortOrder";

    $stmt = $db->prepare($sql);

    // binding parameter jika ada filter
    foreach ($params as $k => $v) {
        $stmt->bindValue($k, $v, PDO::PARAM_INT);
    }

    $stmt->execute();
    $dataMahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
    $dataMahasiswa = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Mahasiswa</title>
<style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 20px; }
    .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    .filter-form { background: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #343a40; color: white; }
    button, select, input { padding: 6px 10px; margin-right: 8px; }
    .btn { background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    .btn:hover { background: #0056b3; }
    .edit-form { display: inline; }
</style>
</head>
<body>
<div class="container">
    <h1>Data Mahasiswa</h1>

    <!-- Filter -->
    <div class="filter-form">
        <form method="GET" action="">
            <label>Filter Jurusan:</label>
            <select name="jurusan">
                <option value="">-- Semua Jurusan --</option>
                <?php foreach ($daftarJurusan as $j): ?>
                    <option value="<?= $j['id'] ?>" <?= ($jurusanFilter == $j['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($j['nama_jurusan']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Urutkan:</label>
            <select name="sort_by">
                <option value="nama" <?= ($sortBy == 'nama') ? 'selected' : '' ?>>Nama</option>
                <option value="nim" <?= ($sortBy == 'nim') ? 'selected' : '' ?>>NIM</option>
                <option value="nama_jurusan" <?= ($sortBy == 'nama_jurusan') ? 'selected' : '' ?>>Jurusan</option>
            </select>

            <select name="sort_order">
                <option value="ASC" <?= ($sortOrder == 'ASC') ? 'selected' : '' ?>>ASC</option>
                <option value="DESC" <?= ($sortOrder == 'DESC') ? 'selected' : '' ?>>DESC</option>
            </select>

            <button type="submit" class="btn">Terapkan Filter</button>
            <button type="button" class="btn" onclick="window.location.href='tampil_mahasiswa_join.php'">Reset</button>
        </form>
    </div>

    <!-- Tabel -->
    <?php if (!empty($error)): ?>
        <div style="color:red"><?= $error ?></div>
    <?php elseif (empty($dataMahasiswa)): ?>
        <p>Tidak ada data mahasiswa ditemukan.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataMahasiswa as $mhs): ?>
                <tr>
                    <td><?= htmlspecialchars($mhs['nim']) ?></td>
                    <td><?= htmlspecialchars($mhs['nama']) ?></td>
                    <td><?= htmlspecialchars($mhs['nama_jurusan']) ?></td>
                    <td>
                        <form method="POST" class="edit-form">
                            <input type="hidden" name="nim" value="<?= htmlspecialchars($mhs['nim']) ?>">
                            <input type="text" name="nama_baru" placeholder="Ubah nama..." required>
                            <button type="submit" name="update" class="btn">Simpan</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total: <?= count($dataMahasiswa) ?> mahasiswa</p>
    <?php endif; ?>
</div>
</body>
</html>