<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../admin/index.php');
    exit;
}

$id = $_POST['id'] ?? '';
$name = trim($_POST['nama_produk'] ?? '');
$price = trim($_POST['harga'] ?? '');
$description = trim($_POST['deskripsi'] ?? '');
$stock = trim($_POST['stok'] ?? '');
$category = trim($_POST['kategori'] ?? '');

if (!ctype_digit((string) $id)) {
    header('Location: ../admin/index.php');
    exit;
}

if ($name === '' || $price === '' || $description === '' || $stock === '' || $category === '') {
    header('Location: ../form/form-update.php?id=' . urlencode($id));
    exit;
}

if (!is_numeric($price) || !ctype_digit($stock)) {
    echo "Harga dan stok harus berupa angka!";
    exit;
}

// Ambil gambar lama dari database
$stmt = $pdo->prepare("SELECT gambar FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: ../admin/index.php');
    exit;
}

$image = $product['gambar'];
$oldImage = null;
$targetDir = __DIR__ . "/../uploads/";

// Proses gambar baru hanya jika ada file yang diupload
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
    if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        echo "Gagal mengunggah gambar!";
        exit;
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
    $fileExtension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Hanya file gambar .jpg, .jpeg, .png, .webp, .avif yang diperbolehkan!";
        exit;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES['gambar']['tmp_name']);
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
    if (!in_array($mime, $allowedMime)) {
        echo "File bukan gambar yang valid!";
        exit;
    }

    if ($_FILES['gambar']['size'] > 1024 * 1024) {
        echo "Ukuran file gambar tidak boleh lebih dari 1MB!";
        exit;
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $newImage = uniqid('', true) . '.' . $fileExtension;
    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $targetDir . $newImage)) {
        echo "Gagal mengunggah gambar!";
        exit;
    }

    $oldImage = $product['gambar'];
    $image = $newImage;
}

$sql = "UPDATE products
        SET nama_produk = ?, harga = ?, deskripsi = ?, stok = ?, kategori = ?, gambar = ?
        WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $price, $description, $stock, $category, $image, $id]);

// Hapus gambar lama setelah update berhasil
if (!empty($oldImage)) {
    $oldPath = $targetDir . basename($oldImage);
    if (is_file($oldPath)) {
        unlink($oldPath);
    }
}

header('Location: ../admin/index.php');
exit;
?>