<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="fw-bold fs-2 text-dark mb-1">Daftar Produk</h1>
                <p class="text-secondary small mb-0">Kelola inventaris dan katalog produk toko Anda.</p>
            </div>
            <button type="button" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold" data-bs-toggle="modal"
                data-bs-target="#modalTambahProduk">
                <i class="fa-solid fa-plus me-1"></i> Tambah Produk
            </button>

            <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow rounded-4">
                        @csrf

                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="modalTambahProdukLabel">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="price" class="form-label fw-medium">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="price" name="price" min="0"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="stock" class="form-label fw-medium">Stok</label>
                                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="mb-0">
                                <label for="thumbnail" class="form-label fw-medium">Thumbnail</label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                                    accept="image/*">
                            </div>
                        </div>

                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold">Simpan</button>
                        </div>
                    </div>
                </div>
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
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal" data-bs-target="#modalEditProduk">
                                        Edit
                                    </button>
                                    <button type="submit" class="btn btn-sm text-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="modalEditProdukLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title fw-bold" id="modalEditProdukLabel">Edit Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="edit_name" class="form-label fw-medium">Nama Produk</label>
                                        <input type="text" class="form-control" id="edit_name" name="name"
                                            value="Produk A" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="edit_price" class="form-label fw-medium">Harga</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control" id="edit_price" name="price"
                                                    value="10000" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="edit_stock" class="form-label fw-medium">Stok</label>
                                            <input type="number" class="form-control" id="edit_stock" name="stock"
                                                value="10" min="0" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="edit_description" class="form-label fw-medium">Deskripsi</label>
                                        <textarea class="form-control" id="edit_description" name="description"
                                            rows="3">Deskripsi</textarea>
                                    </div>

                                    <div class="mb-0">
                                        <label for="edit_thumbnail" class="form-label fw-medium">Thumbnail</label>
                                        <div class="mb-2">
                                            <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <i class="fa-regular fa-image text-secondary"></i>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control" id="edit_thumbnail" name="thumbnail"
                                            accept="image/*">
                                        <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
                                    </div>
                                </div>

                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="/" class="btn btn-dark rounded-pill px-4 fw-semibold">Simpan
                                        Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>