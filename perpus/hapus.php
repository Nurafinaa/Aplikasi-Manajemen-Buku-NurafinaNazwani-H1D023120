<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah ID ada di database
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch();

    if ($book) {
        // Jika buku ditemukan, hapus
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);

        // Redirect ke index.php setelah berhasil menghapus
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Buku tidak ditemukan!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
}
?>
