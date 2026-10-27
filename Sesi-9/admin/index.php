<?php
require '../koneksi.php';
// Read
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - AppStore</title>
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
        </div>
    </nav>

    <!-- Page Header -->
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="fw-bold fs-2 text-dark mb-1">Daftar Produk</h1>
                <p class="text-secondary small mb-0">Kelola inventaris dan katalog produk toko Anda.</p>
            </div>
            <div>
                <a href="../form/form-create.php" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Produk Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container pb-5 flex-grow-1">
        <?php if (!empty($products)): ?>
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Stok</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="text-secondary fw-medium">
                                        #<?php echo htmlspecialchars($product['id']); ?>
                                    </td>
                                    <td>
                                        <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center flex-shrink-0"
                                            style="width: 60px; height: 60px;">
                                            <?php if (!empty($product['gambar']) && file_exists('../uploads/' . basename($product['gambar']))): ?>
                                                <img src="../uploads/<?php echo htmlspecialchars(basename($product['gambar'])); ?>"
                                                    alt="Thumbnail" class="w-100 h-100 object-fit-cover">
                                            <?php else: ?>
                                                <i class="fa-regular fa-image text-secondary"></i>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">
                                            <?php echo htmlspecialchars($product['nama_produk']); ?>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo 'Rp ' . number_format($product['harga'], 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <span class="text-secondary small d-inline-block text-truncate"
                                            style="max-width: 250px;">
                                            <?php echo htmlspecialchars($product['deskripsi']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2 py-1">
                                            <?php echo htmlspecialchars($product['stok']); ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="../form/form-update.php?id=<?php echo $product['id']; ?>"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1">
                                                Edit
                                            </a>
                                            <form action="../crud/delete.php" method="post"
                                                onsubmit="return confirm('Hapus produk ini?')">
                                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                                <button type="submit" class="btn btn-sm text-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5">
                <div class="card-body py-4">
                    <div class="mb-3 text-secondary opacity-50 fs-1">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-2">Belum Ada Produk</h3>
                    <p class="text-secondary col-md-6 mx-auto mb-4">Silakan tambahkan produk baru ke dalam database.</p>
                    <a href="form/add_form.php" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold">
                        Tambah Produk Baru
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 text-secondary small border-top flex-shrink-0 mt-auto">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>