<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: center; }
        .error, .success { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .error { background-color: #FFBABA; color: #D8000C; }
        .success { background-color: #DFF2BF; color: #4F8A10; }
    </style>
</head>
<body>

<h1>Manajemen Mahasiswa</h1>

<!-- Form Tambah Mahasiswa -->
<form action="create.php" method="post">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>
    <label for="jurusan">Jurusan:</label>
    <input type="text" id="jurusan" name="jurusan" required>
    <button type="submit">Tambah Mahasiswa</button>
</form>

<!-- Form Hapus Mahasiswa berdasarkan ID -->
<h2>Hapus Mahasiswa</h2>
<form action="delete.php" method="post">
    <label for="id_hapus">ID Mahasiswa:</label>
    <input type="number" id="id_hapus" name="id_hapus" required>
    <button type="submit">Hapus Mahasiswa</button>
</form>

<!-- Daftar Mahasiswa -->
<h2>Daftar Mahasiswa</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            $stmt = $pdo->query('SELECT * FROM mahasiswa');
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "<tr><td colspan='3'>Kesalahan saat mengambil data: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
