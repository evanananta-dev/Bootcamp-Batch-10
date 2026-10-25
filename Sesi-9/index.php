<?php
require 'koneksi.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();

?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - Official Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-light text-dark">
    <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6" href="index.php">
                <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
            </a>

            <div class="d-flex align-items-center justify-content-center gap-3">
                <a href="dashboard.php" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class=" fa-solid"></i>Dashboard</a>
                <a href="cart.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class=" fa-solid fa-bag-shopping me-1"></i>Keranjang</a>

            </div>
        </div>
    </nav>

    <section class="bg-black text-white text-center py-5">
        <div class="container py-5">
            <h1 class="display-3 fw-bold mb-1">Jelajahi Produk Kami</h1>
            <div class="d-flex justify-content-center gap-3 mb-5 py-2">
                <a href="#store-products" class="btn btn-primary rounded-pill px-4 py-2">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <section id="store-products" class="py-5 bg-body-tertiary">
        <div class="container py-4">
            <div class="container pb-5">
                <div id="product-list" class="row g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <?php if (!empty($product['image'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>"
                                        class="card-img-top rounded-top-4"
                                        alt="<?= htmlspecialchars($product['nama_produk']) ?>">
                                <?php else: ?>
                                    <div class="bg-light text-center py-5 rounded-top-4">
                                        <i
                                            class="fa-solid <?= $icons[$product['kategori']] ?? 'fa-box' ?> fa-4x text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($product['nama_produk']) ?></h5>
                                    <p class="card-text text-secondary small">
                                        <?= htmlspecialchars($product['deskripsi'] ?? '') ?>
                                    </p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">Rp
                                            <?= htmlspecialchars(number_format($product['harga'], 0, ',', '.')) ?></span>
                                        <button type="button" class="btn btn-primary btn-sm rounded-pill">
                                            <i class="fa-solid fa-plus me-1"></i>Beli
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-4 text-secondary small border-top">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>
</body>

</html>