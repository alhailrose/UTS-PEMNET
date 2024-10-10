<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    if (!empty($nama) && !empty($jurusan)) {
        try {
            $query = "INSERT INTO mahasiswa (nama, jurusan) VALUES (:nama, :jurusan)";
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':jurusan', $jurusan);

            $stmt->execute();

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo "Kesalahan: " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Nama dan Jurusan harus diisi.";
    }
}
?>
