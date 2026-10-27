<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../form/form-create.php');
    exit;
}

$name = trim($_POST['nama_produk'] ?? '');
$price = trim($_POST['harga'] ?? '');
$description = trim($_POST['deskripsi'] ?? '');
$stock = trim($_POST['stok'] ?? '');
$category = trim($_POST['kategori'] ?? '');

if (
    $name === '' || $price === '' || $description === '' ||
    $stock === '' || $category === '' ||
    !isset($_FILES['gambar']) ||
    $_FILES['gambar']['error'] !== UPLOAD_ERR_OK
) {
    header('Location: ../form/form-create.php');
    exit;
}

if (!is_numeric($price) || !ctype_digit($stock)) {
    echo "Harga dan stok harus berupa angka!";
    exit;
}

// Validasi ekstensi
$allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
$fileExtension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedExtensions)) {
    echo "Hanya file gambar .jpg, .jpeg, .png, .webp, .avif yang diperbolehkan!";
    exit;
}

// Validasi MIME type asli
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($_FILES['gambar']['tmp_name']);
$allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
if (!in_array($mime, $allowedMime)) {
    echo "File bukan gambar yang valid!";
    exit;
}

// Validasi ukuran (maks 1MB)
if ($_FILES['gambar']['size'] > 1024 * 1024) {
    echo "Ukuran file gambar tidak boleh lebih dari 1MB!";
    exit;
}

$targetDir = __DIR__ . "/../uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

// Nama unik, tanpa memakai nama asli dari user
$image = uniqid('', true) . '.' . $fileExtension;
$targetFile = $targetDir . $image;

if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
    $sql = "INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori, gambar)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $price, $description, $stock, $category, $image]);
} else {
    echo "Gagal mengunggah gambar!";
    exit;
}

header('Location: ../admin/index.php');
exit;