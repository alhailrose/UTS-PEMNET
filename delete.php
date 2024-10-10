<?php
include 'db.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_hapus = $_POST['id_hapus'];

    if (!empty($id_hapus) && is_numeric($id_hapus)) {
        $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->bindParam(':id', $id_hapus, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            try {
                $query = "DELETE FROM mahasiswa WHERE id = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id_hapus, PDO::PARAM_INT);
                $stmt->execute();

                showError("Mahasiswa dengan ID $id_hapus berhasil dihapus.", 'success');
            } catch (PDOException $e) {
                showError("Kesalahan: " . htmlspecialchars($e->getMessage()), 'error');
            }
        } else {
            showError("Mahasiswa dengan ID $id_hapus tidak ditemukan.", 'error');
        }
    } else {
        showError("ID yang dimasukkan tidak valid.", 'error');
    }
}

header("refresh:1;url=index.php");
?>
