<?php
require_once "koneksi.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['published_year'];
    $genre = $_POST['genre'];

    $sql = "UPDATE books SET title = ?, author = ?, published_year = ?, genre = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $author, $year, $genre, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Edit Buku</h2>
    <form method="post">
        <div class="mb-3">
            <label>Judul:</label>
            <input type="text" name="title" class="form-control" value="<?= $book['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Penulis:</label>
            <input type="text" name="author" class="form-control" value="<?= $book['author'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Tahun Terbit:</label>
            <input type="number" name="published_year" class="form-control" value="<?= $book['published_year'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Genre:</label>
            <input type="text" name="genre" class="form-control" value="<?= $book['genre'] ?>">
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
