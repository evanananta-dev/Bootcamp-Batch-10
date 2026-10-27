<?php
session_start();
require_once '../koneksi.php';

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Ensure the cart session variable exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart actions (update quantity, remove item, clear cart)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($_POST['action'] === 'remove' && $id > 0) {
        unset($_SESSION['cart'][$id]);
    } elseif ($_POST['action'] === 'update' && $id > 0) {
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;
        if ($quantity > 0) {
            $_SESSION['cart'][$id] = $quantity;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    } elseif ($_POST['action'] === 'clear') {
        $_SESSION['cart'] = [];
    }

    header('Location: cart.php');
    exit;
}

// Load the products that are in the cart
$items = [];
$total = 0;
$total_items = 0;

if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = $pdo->prepare("SELECT id, nama_produk, harga, deskripsi, kategori, gambar FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $quantity = (int) $_SESSION['cart'][$product['id']];
        $subtotal = $product['harga'] * $quantity;

        $total += $subtotal;
        $total_items += $quantity;

        $items[] = [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="d-flex flex-column min-vh-100 bg-white">
    <!-- Navbar -->
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

    <div class="container py-4">
        <h1 class="fw-bold fs-2 text-dark mb-1">Keranjang Belanja</h1>
        <p class="text-secondary small mb-0">Kelola barang pilihan Anda sebelum melakukan proses pembayaran.</p>
    </div>

    <!-- 3. MAIN CONTAINER -->
    <div class="container pb-5">
        <?php if (!empty($items)): ?>
            <div class="row g-4">
                <!-- CART ITEMS -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4 mb-3">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th style="width: 130px;">Jumlah</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <?php $product = $item['product']; ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <!-- Gambar Thumbnails -->
                                                    <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center flex-shrink-0"
                                                        style="width: 60px; height: 60px;">
                                                        <?php
                                                        $img = !empty($product['gambar']) ? $product['gambar'] : (!empty($product['image']) ? $product['image'] : '');
                                                        ?>
                                                        <?php if (!empty($img)): ?>
                                                            <img src="../uploads/<?php echo htmlspecialchars($img); ?>"
                                                                alt="<?php echo htmlspecialchars($product['nama_produk']); ?>"
                                                                class="w-100 h-100 object-fit-cover">
                                                        <?php else: ?>
                                                            <i class="fa-regular fa-image text-secondary"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <a href="detail-product.php?id=<?php echo (int) $product['id']; ?>"
                                                            class="fw-semibold text-decoration-none text-dark">
                                                            <?php echo htmlspecialchars($product['nama_produk']); ?>
                                                        </a>
                                                        <?php if (!empty($product['kategori']) || !empty($product['category'])): ?>
                                                            <div class="small text-muted">
                                                                <?php echo htmlspecialchars(!empty($product['kategori']) ? $product['kategori'] : $product['category']); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">Rp
                                                <?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                <form action="cart.php" method="post" class="d-flex align-items-center gap-1">
                                                    <input type="hidden" name="action" value="update">
                                                    <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                                                    <input type="number" name="quantity"
                                                        value="<?php echo $item['quantity']; ?>" min="0"
                                                        class="form-control form-control-sm text-center rounded-3">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle px-2 py-1"
                                                        title="Perbarui jumlah">
                                                        <i class="fa-solid fa-rotate-right fs-7"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="fw-bold text-nowrap">Rp
                                                <?php echo number_format($item['subtotal'], 0, ',', '.'); ?>
                                            </td>
                                            <td class="text-end">
                                                <form action="cart.php" method="post" class="m-0">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                                                    <button type="submit"
                                                        class="btn btn-sm text-danger border-0 bg-transparent p-1"
                                                        onclick="return confirm('Hapus produk ini dari keranjang?')"
                                                        title="Hapus">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">Lanjut Belanja</a>
                        <form action="cart.php" method="post" class="m-0">
                            <input type="hidden" name="action" value="clear">
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-3 btn-sm"
                                onclick="return confirm('Kosongkan seluruh keranjang?')">
                                <i class="fa-solid fa-trash me-1"></i> Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- SUMMARY CARD -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                        <h4 class="fw-bold mb-3 fs-5 text-dark">Ringkasan Belanja</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Jumlah item</span>
                            <span class="fw-semibold"><?php echo $total_items; ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Subtotal</span>
                            <span class="fw-semibold">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-semibold text-dark">Total</span>
                            <span class="fw-bold fs-4 text-primary">Rp
                                <?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                        <a href="checkout.php" class="btn btn-primary rounded-pill w-100 py-2 fw-semibold">Checkout</a>
                        <p class="text-secondary small text-center mt-3 mb-0">Lanjutkan untuk mengisi data pengiriman</p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5">
                <div class="card-body py-4">
                    <div class="mb-3 text-secondary opacity-50 fs-1">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-2">Keranjang Masih Kosong</h3>
                    <p class="text-secondary col-md-6 mx-auto mb-4">Belum ada produk yang ditambahkan ke keranjang Anda.</p>
                    <a href="index.php" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
                        Mulai Belanja
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer class="bg-light py-4 text-secondary small border-top flex-shrink-0 mt-auto">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>