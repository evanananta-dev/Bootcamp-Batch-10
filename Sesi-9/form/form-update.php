<?php
require '../koneksi.php';

$id = $_GET['id'] ?? '';
if (!ctype_digit((string) $id)) {
    header('Location: ../admin/index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: ../admin/index.php');
    exit;
}

$categories = ["Phone", "Laptop", "Tablet"];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Update</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand text-dark d-flex align-items-center gap-4 fw-semibold fs-6"
                href="../admin/index.php">
                <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
            </a>
            <div class="d-flex align-items-center justify-content-center gap-3">
                <a href="../admin/index.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="container py-4">
        <h1 class="fw-bold fs-2 text-dark mb-1">Edit Produk</h1>
        <p class="text-secondary small mb-0">Perbarui informasi katalog atau detail produk.</p>
    </div>

    <!-- Main Container -->
    <main class="container pb-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5">
                    <form action="../crud/update.php" onsubmit="return validateForm()" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label text-secondary small fw-medium">Nama
                                Produk:</label>
                            <input type="text" class="form-control rounded-pill px-3" id="nama_produk"
                                name="nama_produk" value="<?= htmlspecialchars($product['nama_produk']) ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label text-secondary small fw-medium">Harga (Rp):</label>
                                <input type="number" min="0" step="any" class="form-control rounded-pill px-3"
                                    id="harga" name="harga" value="<?= htmlspecialchars($product['harga']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok" class="form-label text-secondary small fw-medium">Stok:</label>
                                <input type="number" min="0" step="1" class="form-control rounded-pill px-3" id="stok"
                                    name="stok" value="<?= htmlspecialchars($product['stok'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-secondary small fw-medium">Deskripsi:</label>
                            <textarea class="form-control rounded-4 p-3" id="deskripsi" name="deskripsi"
                                rows="4"><?= htmlspecialchars($product['deskripsi']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label text-secondary small fw-medium">Kategori:</label>
                            <select class="form-select rounded-pill px-3 py-2" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category) ?>" <?= (($product['kategori'] ?? '') === $category) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label text-secondary small fw-medium">Gambar (Thumbnail
                                Baru):</label>
                            <input type="file" class="form-control rounded-pill px-3 py-2" id="gambar" name="gambar"
                                accept="image/*">
                            <div class="form-text small text-muted mt-1">Biarkan kosong jika tidak ingin mengubah
                                gambar. Maksimal 1MB.</div>
                        </div>

                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold">Simpan
                                Perubahan</button>
                            <a href="../admin/index.php"
                                class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 text-secondary small border-top flex-shrink-0 mt-auto">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>

    <script>
        function validateForm() {
            const nama = document.getElementById('nama_produk').value.trim();
            const harga = document.getElementById('harga').value.trim();
            const stok = document.getElementById('stok').value.trim();
            const deskripsi = document.getElementById('deskripsi').value.trim();
            const file = document.getElementById('gambar').files[0];

            if (!nama || !harga || !stok || !deskripsi) {
                alert('Semua field harus diisi!');
                return false;
            }
            if (file && file.size > 1024 * 1024) {
                alert('Ukuran gambar maksimal 1MB!');
                return false;
            }
            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>