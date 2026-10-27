<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin/index.php');
    exit;
}

$id = $_POST['id'] ?? '';

if (!ctype_digit((string) $id)) {
    header('Location: ../admin/index.php');
    exit;
}

// Ambil nama file gambar
$stmt = $pdo->prepare("SELECT gambar FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: ../admin/index.php');
    exit;
}

// Hapus data dari database dulu
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// Setelah data terhapus, baru hapus file gambarnya
if (!empty($product['gambar'])) {
    $imagePath = __DIR__ . "/../uploads/" . basename($product['gambar']);
    if (is_file($imagePath)) {
        unlink($imagePath);
    }
}

header('Location: ../admin/index.php');
exit;
?>