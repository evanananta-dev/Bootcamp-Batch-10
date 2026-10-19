<?php
require 'koneksi_db.php';
 
$cols = $pdo->query("SHOW COLUMNS FROM products")->fetchAll(PDO::FETCH_COLUMN);
 
function pickCol(array $cols, array $candidates) {
    foreach ($candidates as $c) {
        foreach ($cols as $real) {
            if (strcasecmp($real, $c) === 0) return $real;
        }
    }
    return null;
}
 
$colId    = pickCol($cols, ['id', 'id_produk', 'product_id', 'id_product']);
$colName  = pickCol($cols, ['name', 'nama', 'nama_produk', 'product_name', 'title']);
$colCat   = pickCol($cols, ['category', 'kategori', 'kategori_produk']);
$colPrice = pickCol($cols, ['price', 'harga', 'harga_produk']);
$colDesc  = pickCol($cols, ['description', 'deskripsi', 'keterangan']);
$colImg   = pickCol($cols, ['image', 'gambar', 'foto', 'img', 'image_url']);
 
if (!$colName || !$colPrice) {
    die('Kolom nama/harga tidak ditemukan. Kolom di tabel products: ' . htmlspecialchars(implode(', ', $cols)));
}
 
// --- Ambil input filter dari URL (GET) ---
$q        = trim($_GET['q'] ?? '');
$category = $_GET['category'] ?? 'all';
$sort     = $_GET['sort'] ?? 'default';
 
$allowedCategories = ['Phone', 'Laptop', 'Tablet'];
 
// --- Bangun query dengan alias, jadi HTML di bawah tidak perlu diubah ---
$select = [
    ($colId   ? "`$colId`"   : "0")    . " AS id",
    "`$colName`"                       . " AS name",
    ($colCat  ? "`$colCat`"  : "''")   . " AS category",
    "`$colPrice`"                      . " AS price",
    ($colDesc ? "`$colDesc`" : "''")   . " AS description",
    ($colImg  ? "`$colImg`"  : "NULL") . " AS image",
];
 
$sql    = "SELECT " . implode(', ', $select) . " FROM products WHERE 1=1";
$params = [];
 
if ($q !== '') {
    $sql .= " AND `$colName` LIKE :q";
    $params[':q'] = '%' . $q . '%';
}
 
if ($colCat && in_array($category, $allowedCategories, true)) {
    $sql .= " AND `$colCat` = :category";
    $params[':category'] = $category;
} else {
    $category = 'all';
}
 
if ($sort === 'price-low-high') {
    $sql .= " ORDER BY `$colPrice` ASC";
} elseif ($sort === 'price-high-low') {
    $sql .= " ORDER BY `$colPrice` DESC";
} else {
    $sort = 'default';
    if ($colId) $sql .= " ORDER BY `$colId` ASC";
}
 
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
 
$icons = ['Phone' => 'fa-mobile-screen', 'Laptop' => 'fa-laptop', 'Tablet' => 'fa-tablet-screen-button'];
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - Official Home</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  </head>
  <body class="bg-light text-dark">
    <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
      <div class="container">
        <a
          class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6"
          href="index.php"
        >
          <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
        </a>

        <div class="d-flex align-items-center justify-content-center gap-3">
            <a href="cart" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Tambah Produk</a>
        </div>
      </div>
    </nav>

    <section class="bg-black text-white text-center py-5">
      <div class="container py-5">
        <h1 class="display-3 fw-bold mb-1">Jelajahi Produk Kami</h1>
        <div class="d-flex justify-content-center gap-3 mb-5 py-2">
          <a href="#store-products" class="btn btn-primary rounded-pill px-4 py-2"
            >Pelajari Lebih Lanjut</a
          >
        </div>
      </div>
    </section>

    <section id="store-products" class="py-5 bg-white">
      <div class="container py-4">
        <div class="container pb-5">
          <form method="get" action="index.php#store-products" class="row g-3 mb-4">
            <div class="col-md-5">
              <label for="search-input" class="form-label">Cari produk</label>
              <input
                type="text"
                id="search-input"
                name="q"
                class="form-control"
                placeholder="Contoh: AppPhone"
                value="<?= htmlspecialchars($q) ?>"
              />
            </div>

            <div class="col-md-3">
              <label for="category-filter" class="form-label">Kategori</label>
              <select id="category-filter" name="category" class="form-select" onchange="this.form.submit()">
                <option value="all">Semua kategori</option>
                <?php foreach ($allowedCategories as $c): ?>
                  <option value="<?= $c ?>" <?= $category === $c ? 'selected' : '' ?>><?= $c ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-3">
              <label for="sort-filter" class="form-label">Urutkan harga</label>
              <select id="sort-filter" name="sort" class="form-select" onchange="this.form.submit()">
                <option value="default" <?= $sort === 'default' ? 'selected' : '' ?>>Default</option>
                <option value="price-low-high" <?= $sort === 'price-low-high' ? 'selected' : '' ?>>Harga: Rendah ke Tinggi</option>
                <option value="price-high-low" <?= $sort === 'price-high-low' ? 'selected' : '' ?>>Harga: Tinggi ke Rendah</option>
              </select>
            </div>

            <div class="col-md-1 d-flex align-items-end">
              <button type="submit" class="btn btn-dark w-100">Cari</button>
            </div>
          </form>

          <p id="product-count" class="text-secondary">
            Menampilkan <?= count($products) ?> produk
          </p>

          <div id="product-list" class="row g-4">
            <?php foreach ($products as $p): ?>
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                  <?php if (!empty($p['image'])): ?>
                    <img src="" class="card-img-top rounded-top-4" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                  <?php else: ?>
                    <div class="bg-light text-center py-5 rounded-top-4">
                      <i class="fa-solid <?= $icons[$p['category']] ?? 'fa-box' ?> fa-4x text-secondary"></i>
                    </div>
                  <?php endif; ?>
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
                    <p class="card-text text-secondary small"><?= htmlspecialchars($p['description'] ?? '') ?></p>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                      <span class="fw-semibold"><?= htmlspecialchars(number_format($p['price'], 0, ',', '.')) ?></span>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm rounded-pill"
                      >
                        <i class="fa-solid fa-plus me-1"></i>Beli
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <?php if (count($products) === 0): ?>
            <div id="empty-message" class="text-center py-5">
              <h4>Produk tidak ditemukan</h4>
              <p class="text-secondary">Coba kata kunci atau kategori lainnya.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <footer class="bg-light py-4 text-secondary small border-top">
      <div class="container">
        <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
      </div>
    </footer>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
      <div
        id="cartToast"
        class="toast align-items-center text-white bg-dark border-0 rounded-3 shadow"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
      >
        <div class="d-flex">
          <div class="toast-body" id="toastText">
            Produk berhasil ditambahkan ke tas belanja.
          </div>
          <button
            type="button"
            class="btn-close btn-close-white me-2 m-auto"
            data-bs-dismiss="toast"
          ></button>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="home.js"></script>
  </body>
</html>