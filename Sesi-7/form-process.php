<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = trim($_POST["nama_produk"]);
    $harga       = trim($_POST["harga"]);
    $kategori    = trim($_POST["kategori"]);
    $stok        = trim($_POST["stok"]);
    $deskripsi   = trim($_POST["deskripsi"]);
    $gambar      = trim($_POST["gambar_url"]);

    if ($nama_produk === '' || $harga === '' || $kategori === '' ||
        $stok === '' || $deskripsi === '' || $gambar === '') {
        echo "Semua field harus diisi.";
        exit;
    }

    echo "<h3>Data diterima!</h3>";
    echo "Nama Produk: " . htmlspecialchars($nama_produk) . "<br>";
    echo "Harga: Rp " . number_format((int)$harga, 0, ',', '.') . "<br>";
    echo "Kategori: " . htmlspecialchars($kategori) . "<br>";
    echo "Stok: " . (int)$stok . " unit<br>";
    echo "Deskripsi: " . nl2br(htmlspecialchars($deskripsi)) . "<br>";
    echo "Gambar: " . htmlspecialchars($gambar) . "<br>";
} else {
    echo "Akses tidak valid. Silakan isi form terlebih dahulu.";
}
?>