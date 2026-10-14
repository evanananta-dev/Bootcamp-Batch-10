<?php
// ===== Helper =====
function e($teks) {
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

// ===== Konfigurasi =====
$daftarKategori = ['Phone', 'Laptop', 'Tablet', 'Aksesoris'];

// ===== State =====
$errors = [];
$sukses = false;
$old = [
    'nama_produk' => '',
    'harga'       => '',
    'kategori'    => '',
    'gambar_url'  => '',
];
$harga = 0;

// ===== Proses form (hanya saat dikirim lewat POST) =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $_) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['nama_produk'] === '') {
        $errors[] = 'Nama produk wajib diisi.';
    }

    $harga = filter_var($old['harga'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($harga === false) {
        $errors[] = 'Harga harus berupa angka bulat lebih dari 0.';
    }

    if (!in_array($old['kategori'], $daftarKategori, true)) {
        $errors[] = 'Pilih kategori yang valid.';
    }

    // URL harus valid dan hanya boleh http/https (mencegah javascript: dan sejenisnya)
    $scheme = strtolower((string) parse_url($old['gambar_url'], PHP_URL_SCHEME));
    if (!filter_var($old['gambar_url'], FILTER_VALIDATE_URL) || !in_array($scheme, ['http', 'https'], true)) {
        $errors[] = 'URL gambar harus valid dan diawali http:// atau https://.';
    }

    $sukses = empty($errors);
}
?>
