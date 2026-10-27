<?php
session_start();
require_once '../koneksi.php';

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

// Ensure the cart session variable exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Redirect back to the cart if there is nothing to check out
if (empty($_SESSION['cart'])) {
    header('Location: keranjang.php');
    exit;
}

// Load the products that are in the cart
$items = [];
$total = 0;
$total_items = 0;

$ids = array_keys($_SESSION['cart']);
$placeholders = implode(',', array_fill(0, count($ids), '?'));

$stmt = $pdo->prepare("SELECT id, nama_produk, harga, kategori, gambar FROM products WHERE id IN ($placeholders)");
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

// Validation errors and previously entered values (from process_order.php)
$errors = isset($_SESSION['checkout_errors']) ? $_SESSION['checkout_errors'] : [];
$old = isset($_SESSION['checkout_old']) ? $_SESSION['checkout_old'] : ['user_name' => '', 'address' => '', 'phone' => ''];
unset($_SESSION['checkout_errors'], $_SESSION['checkout_old']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Header -->
    <main class="flex-grow-1 py-5">
        <div class="container-lg">
            <!-- Header Section -->
            <div class="mb-5">
                <h1 class="fw-bold mb-1">Checkout</h1>
                <p class="text-secondary mb-0">Tinjau pesanan Anda dan lengkapi data pengiriman</p>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                    <strong>Mohon periksa kembali data Anda:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="process_order.php" method="post">
                <div class="row g-4">
                    <!-- Review Order Items & Shipping Form -->
                    <div class="col-lg-7">
                        <!-- Review Pesanan Card -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light">
                            <h4 class="fw-semibold mb-3 fs-5">Review Pesanan</h4>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 bg-transparent">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0 bg-transparent">Produk</th>
                                            <th class="border-0 bg-transparent">Harga</th>
                                            <th class="border-0 bg-transparent text-center">Qty</th>
                                            <th class="border-0 bg-transparent text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item): ?>
                                            <?php $product = $item['product']; ?>
                                            <tr>
                                                <td class="border-bottom">
                                                    <div class="d-flex align-items-center gap-3 py-1">
                                                        <?php if (!empty($product['gambar']) && file_exists('uploads/' . basename($product['gambar']))): ?>
                                                            <img src="uploads/<?php echo htmlspecialchars(basename($product['gambar'])); ?>"
                                                                alt="<?php echo htmlspecialchars($product['nama_produk']); ?>"
                                                                class="rounded-3 object-fit-cover"
                                                                style="width: 50px; height: 50px;">
                                                        <?php else: ?>
                                                            <div class="bg-white rounded-3 d-flex align-items-center justify-content-center text-secondary border shadow-sm"
                                                                style="width: 50px; height: 50px;">
                                                                <i class="fa-solid fa-image"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div>
                                                            <div class="fw-semibold text-dark">
                                                                <?php echo htmlspecialchars($product['nama_produk']); ?>
                                                            </div>
                                                            <?php if (!empty($product['kategori'])): ?>
                                                                <div class="small text-secondary">
                                                                    <?php echo htmlspecialchars($product['kategori']); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-bottom text-secondary">Rp
                                                    <?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                                </td>
                                                <td class="border-bottom text-center fw-medium">
                                                    <?php echo $item['quantity']; ?>
                                                </td>
                                                <td class="border-bottom text-end fw-semibold text-dark">
                                                    Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Data Pengiriman Card -->
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-semibold mb-3 fs-5">Data Pengiriman</h4>
                            <div class="mb-3">
                                <label for="user_name" class="form-label text-secondary small fw-medium">Nama Penerima
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-3" id="user_name"
                                    name="user_name"
                                    value="<?php echo isset($old['user_name']) ? htmlspecialchars($old['user_name']) : ''; ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label text-secondary small fw-medium">Alamat Lengkap
                                    <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-4 p-3" id="address" name="address" rows="3"
                                    required><?php echo isset($old['address']) ? htmlspecialchars($old['address']) : ''; ?></textarea>
                            </div>
                            <div class="mb-0">
                                <label for="phone" class="form-label text-secondary small fw-medium">Nomor Telepon <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-3" id="phone" name="phone"
                                    value="<?php echo isset($old['phone']) ? htmlspecialchars($old['phone']) : ''; ?>"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Column -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 90px;">
                            <h4 class="fw-semibold mb-3 fs-5">Ringkasan Pembayaran</h4>
                            <div class="d-flex justify-content-between mb-2 text-secondary">
                                <span>Jumlah item</span>
                                <span
                                    class="fw-medium text-dark"><?php echo isset($total_items) ? $total_items : 0; ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-secondary">
                                <span>Subtotal</span>
                                <span class="fw-medium text-dark">Rp
                                    <?php echo isset($total) ? number_format($total, 0, ',', '.') : '0'; ?></span>
                            </div>
                            <hr class="text-muted opacity-25">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold fs-5 text-dark">Total</span>
                                <span class="fw-bold fs-5 text-dark">Rp
                                    <?php echo isset($total) ? number_format($total, 0, ',', '.') : '0'; ?></span>
                            </div>
                            <button type="submit" class="btn btn-dark rounded-pill py-2 w-100 fw-medium shadow-sm">Buat
                                Pesanan</button>
                            <a href="cart.php"
                                class="btn btn-outline-secondary rounded-pill py-2 w-100 mt-2 fw-medium">Kembali ke
                                Keranjang</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 text-secondary small border-top flex-shrink-0 mt-auto">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>