<?php
include 'db.php';
include 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $mahasiswa = $stmt->fetch();
    } else {
        showError("Mahasiswa dengan ID $id tidak ditemukan.", 'error');
        exit();
    }
} else {
    showError("ID tidak diberikan.", 'warning');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    if (!empty($nama) && !empty($jurusan)) {
        try {
            // Query untuk memperbarui data mahasiswa
            $query = "UPDATE mahasiswa SET nama = :nama, jurusan = :jurusan WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':jurusan', $jurusan);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Tampilkan pesan sukses
            showError("Data mahasiswa berhasil diperbarui.", 'success');

            header("refresh:1;url=index.php");
            exit();
        } catch (PDOException $e) {
            showError("Kesalahan: " . htmlspecialchars($e->getMessage()), 'error');
        }
    } else {
        showError("Nama dan Jurusan tidak boleh kosong.", 'warning');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .error, .success, .warning { 
            padding: 10px; 
            margin: 15px 0;
        }
        .error { background-color: #FFBABA; color: #D8000C; }
        .success { background-color: #DFF2BF; color: #4F8A10; }
        .warning { background-color: #FEEFB3; color: #9F6000; }
    </style>
</head>
<body>

<h1>Edit Mahasiswa</h1>

<?php if (!empty($error_message)): ?>
    <div class="error"><?= htmlspecialchars($error_message) ?></div>
<?php endif; ?>

<form action="" method="post">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" required>
    <label for="jurusan">Jurusan:</label>
    <input type="text" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($mahasiswa['jurusan']); ?>" required>
    <button type="submit">Simpan Perubahan</button>
</form>

</body>
</html>
