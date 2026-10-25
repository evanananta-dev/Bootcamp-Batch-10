<?php
require 'koneksi.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll()
  ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Store - Official Dasboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-light text-dark">
  <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6" href="index.php">
        <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
      </a>
    </div>
  </nav>

  <section class="bg-body-secondary py-5">
    <div class="container py-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2 class="h3 fw-bold mb-1">Katalog Produk</h2>
          <p class="text-secondary small mb-0">Kelola dan pantau seluruh produk yang tersedia.</p>
        </div>
        <a href="form/form-input.php" class="btn btn-primary rounded-pill px-3 shadow-sm">
          <i class="fa-solid fa-plus me-1"></i> Tambah Produk
        </a>
      </div>
  </section>

  <section id="dashboard-products" class="py-5">
    <div class="container">
      <!-- Grid Produk (Kotak-Kotak) -->
      <div id="product-list" class="row g-4 justify-content-center">
        <?php foreach ($products as $product): ?>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative text-center">

              <!-- Badge Kategori (Di Atas Tengah) -->
              <span
                class="position-absolute top-0 start-50 translate-middle-x mt-3 badge bg-white text-dark shadow-sm rounded-pill px-3 py-2 z-1">
                <i class="fa-solid <?= $icons[$product['kategori']] ?? 'fa-box' ?> text-primary me-1"></i>
                <?= htmlspecialchars($product['kategori'] ?? 'Umum') ?>
              </span>

              <!-- Gambar Produk / Placeholder -->
              <?php if (!empty($product['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($product['image']) ?>" class="card-img-top object-fit-cover"
                  style="height: 180px;" alt="<?= htmlspecialchars($product['nama_produk']) ?>">
              <?php else: ?>
                <div class="bg-body-secondary text-center py-5 d-flex align-items-center justify-content-center"
                  style="height: 180px;">
                  <i class="fa-solid <?= $icons[$product['kategori']] ?? 'fa-box' ?> fa-3x text-secondary opacity-50"></i>
                </div>
              <?php endif; ?>

              <!-- Body Card -->
              <div class="card-body d-flex flex-column align-items-center">
                <!-- Judul / Nama Produk -->
                <h6 class="card-title fw-bold text-dark mb-1 text-truncate w-100"
                  title="<?= htmlspecialchars($product['nama_produk']) ?>">
                  <?= htmlspecialchars($product['nama_produk']) ?>
                </h6>

                <!-- Deskripsi Produk -->
                <p class="card-text text-secondary small flex-grow-1 mb-3"
                  style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                  <?= htmlspecialchars($product['deskripsi'] ?? 'Tidak ada deskripsi.') ?>
                </p>

                <!-- Informasi Stok & Harga (Ditengah) -->
                <div class="d-flex flex-column align-items-center gap-1 mb-3 w-100">
                  <span class="fw-bold text-primary fs-6">
                    Rp <?= number_format((float) ($product['harga'] ?? 0), 0, ',', '.') ?>
                  </span>
                  <span class="badge bg-light text-secondary border rounded-pill px-3 py-1">
                    Stok: <?= (int) ($product['stok'] ?? 0) ?>
                  </span>
                </div>

                <!-- Tombol Aksi (Edit & Hapus Ditengah) -->
                <div class="d-flex justify-content-center gap-2 pt-2 border-top w-100">
                  <a href="admin.php?hal=edit&id=<?= (int) $product['id'] ?>"
                    class="btn btn-outline-secondary btn-sm rounded-pill flex-grow-1 fw-medium">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                  </a>
                  <a href="admin.php?hal=hapus&id=<?= (int) $product['id'] ?>"
                    class="btn btn-outline-danger btn-sm rounded-pill flex-grow-1 fw-medium"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                    <i class="fa-solid fa-trash me-1"></i> Hapus
                  </a>
                </div>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <footer class="bg-light py-4 text-secondary small border-top">
    <div class="container">
      <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>