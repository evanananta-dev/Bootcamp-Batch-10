<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="fw-bold fs-2 text-dark mb-1">Daftar Produk</h1>
                <p class="text-secondary small mb-0">Kelola inventaris dan katalog produk toko Anda.</p>
            </div>
            <div>
                <a href="../form/form-create.php" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Produk
                </a>
            </div>
        </div>
    </div>

    <div class="container pb-5 flex-grow-1">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                        <tr>
                            <td class="text-secondary fw-medium">1</td>
                            <td>
                                <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width: 60px; height: 60px;">
                                    <img src="../uploads/" alt="Thumbnail" class="w-100 h-100 object-fit-cover">
                                    <i class="fa-regular fa-image text-secondary"></i>
                                </div>
                            </td>
                            <td class="fw-semibold">Produk A</td>
                            <td class="text-nowrap">10.000</td>
                            <td>
                                <span class="text-secondary small d-inline-block text-truncate"
                                    style="max-width: 250px;">
                                    Deskripsi
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border">10</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Edit</a>
                                    <button type="submit" class="btn btn-sm text-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>