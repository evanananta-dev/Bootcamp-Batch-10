<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store - Official New</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-body-tertiary text-dark d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6" href="../index.php">
                <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="container py-5 flex-grow-1" style="max-width: 860px;">

        <!-- Header Title -->
        <div class="mb-4 pb-2">
            <h1 class="fw-bold mb-1 fs-2">Tambah Produk Baru</h1>
            <p class="text-secondary small mb-0">Isi detail informasi produk untuk ditambahkan ke katalog inventaris.
            </p>
        </div>

        <!-- Form Card Container -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <form action="create.php" method="POST" enctype="multipart/form-data">

                <div class="row g-4">

                    <!-- Nama Produk -->
                    <div class="col-md-8">
                        <label for="nama_produk" class="form-label small fw-semibold text-dark">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="form-control bg-body-tertiary border-0 rounded-3 py-2 px-3 fs-6"
                            placeholder="misal: AppPhone" required>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-4">
                        <label for="kategori" class="form-label small fw-semibold text-dark">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="form-select bg-body-tertiary border-0 rounded-3 py-2 px-3 fs-6" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="iPhone">Phone</option>
                            <option value="MacBook">Laptop</option>
                            <option value="iPad">Tablet</option>
                        </select>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6">
                        <label for="harga" class="form-label small fw-semibold text-dark">Harga Produk</label>
                        <div class="input-group">
                            <span
                                class="input-group-text bg-body-tertiary border-0 rounded-start-3 text-secondary fw-medium px-3">Rp</span>
                            <input type="number" id="harga" name="harga"
                                class="form-control bg-body-tertiary border-0 rounded-end-3 py-2 px-3 fs-6" min="0"
                                placeholder="0" required>
                        </div>
                    </div>

                    <!-- Stok -->
                    <div class="col-md-6">
                        <label for="stok" class="form-label small fw-semibold text-dark">Jumlah Stok</label>
                        <input type="number" id="stok" name="stok"
                            class="form-control bg-body-tertiary border-0 rounded-3 py-2 px-3 fs-6" min="0"
                            placeholder="0" required>
                    </div>

                    <!-- Upload Gambar Produk -->
                    <div class="col-12">
                        <label class="form-label small fw-semibold text-dark">Gambar Produk</label>
                        <div class="border border-2 border-dashed bg-body-tertiary rounded-3 p-4 text-center cursor-pointer position-relative"
                            onclick="document.getElementById('gambar').click();">
                            <i class="fa-solid fa-cloud-arrow-up fs-3 text-secondary mb-2"></i>
                            <div class="fw-medium small text-dark">Klik untuk unggah gambar produk</div>
                            <div class="text-secondary small mt-1" style="font-size: 0.75rem;">PNG, JPG, atau WEBP
                                (Maks. 2MB)</div>
                            <input type="file" id="gambar" name="gambar" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-12">
                        <label for="deskripsi" class="form-label small fw-semibold text-dark">Deskripsi Ringkas</label>
                        <textarea id="deskripsi" name="deskripsi"
                            class="form-control bg-body-tertiary border-0 rounded-3 py-2 px-3 fs-6" rows="3"
                            placeholder="Tuliskan spesifikasi mendasar atau deskripsi singkat..."></textarea>
                    </div>

                </div>

                <!-- Form Footer Actions -->
                <div class="d-flex align-items-center justify-content-end gap-3 mt-5 pt-4 border-top">
                    <a href="../dashboard.php"
                        class="btn btn-secondary rounded-pill px-4 py-2 text-decoration-none fw-medium">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-medium">
                        Simpan Produk
                    </button>
                </div>

            </form>
        </div>

    </main>

    <!-- Clean Footer -->
    <footer class="bg-light py-4 text-secondary small border-top">
        <div class="container">
            <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>