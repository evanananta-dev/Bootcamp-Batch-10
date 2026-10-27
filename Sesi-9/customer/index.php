<?php
session_start();
require_once '../koneksi.php';

// Total number of items in the cart (for the navbar badge)
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT id, nama_produk, harga, deskripsi, kategori, gambar FROM products WHERE 1=1";
$params = [];

if (!empty($search)) {
    $sql .= " AND nama_produk LIKE ?";
    $params[] = '%' . $search . '%';
}

if (!empty($category_filter) && $category_filter !== 'all') {
    $sql .= " AND kategori = ?";
    $params[] = $category_filter;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
$stmtCat = $pdo->query("
    SELECT DISTINCT kategori
    FROM products
    WHERE kategori IS NOT NULL AND kategori != ''
    ORDER BY kategori ASC
");

$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand text-dark d-flex align-items-center gap-4 fw-semibold fs-6" href="index.php">
                <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
            </a>
            <div class="d-flex align-items-center justify-content-center gap-3">
                <a href="cart.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Cart
                    <?php if ($cart_count > 0): ?>
                        <span class="badge bg-dark ms-1">
                            <?php echo $cart_count; ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </nav>

    <header>
        <section class="bg-black text-white text-center py-5">
            <div class="container py-5">
                <h1 class="display-3 fw-bold mb-1">Jelajahi Produk Kami</h1>
                <div class="d-flex justify-content-center gap-3 mb-5 py-2">
                    <a href="#store-products" class="btn btn-primary rounded-pill px-4 py-2">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </section>
    </header>

    <section id="store-products" class="py-5 bg-white">
        <div class="container py-4">
            <div class="container pb-5">
                <form method="get" action="index.php#store-products" class="row g-3 mb-4">
                    <div class="col-md-5">
                        <label for="search-input" class="form-label">Cari produk</label>
                        <input type="text" id="search-input" name="search" class="form-control"
                            placeholder="Contoh: AppPhone" value="<?= htmlspecialchars($search) ?>" />
                    </div>

                    <div class="col-md-3">
                        <label for="category-filter" class="form-label">Kategori</label>

                        <select id="category-filter" name="category" class="form-select" onchange="this.form.submit()">

                            <option value="all" <?= ($category_filter === 'all' || $category_filter === '') ? 'selected' : '' ?>>
                                Semua kategori
                            </option>

                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['kategori'], ENT_QUOTES, 'UTF-8') ?>"
                                    <?= $category_filter === $cat['kategori'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['kategori'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>


                </form>

                <p id="product-count" class="text-secondary">
                    Menampilkan <?= count($products) ?> produk
                </p>

                <div id="product-list" class="row g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <?php if (!empty($product['gambar'])): ?>
                                    <img src="../uploads/<?= rawurlencode($product['gambar']) ?>"
                                        class="card-img-top rounded-top-4 w-100" style="aspect-ratio: 4 / 3; object-fit: cover;"
                                        alt="<?= htmlspecialchars($product['nama_produk']) ?>">
                                <?php else: ?>
                                    <div class="bg-light text-secondary d-flex align-items-center justify-content-center rounded-top-4"
                                        style="aspect-ratio: 4 / 3;">
                                        No image
                                    </div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="detail-product.php?id=<?php echo (int) $product['id']; ?>"
                                            class="text-decoration-none" style="color: inherit;">
                                            <?php echo htmlspecialchars($product['nama_produk']); ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-secondary small    ">
                                        <?php echo htmlspecialchars($product['deskripsi']); ?>
                                    </p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold">
                                            <?php echo 'Rp ' . number_format($product['harga'], 0, ',', '.'); ?>
                                        </span>
                                        <form action="add-to-cart.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill">
                                                <i class="fa-solid fa-plus me-1"></i>Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                    <button type="checkout.php" class="btn btn-primary btn-sm rounded-pill">
                                        <i class="fa-solid me-1"></i>Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-4 text-secondary small border-top flex-shrink-0 mt-auto">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>
</body>

</html>