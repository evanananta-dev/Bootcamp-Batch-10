<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="fw-bold fs-2 text-dark mb-1">Daftar Kategori</h1>
                <p class="text-secondary small mb-0">Kelola inventaris dan katalog produk toko Anda.</p>
            </div>
            <button type="button" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold" data-bs-toggle="modal"
                data-bs-target="#modalTambahKategori">
                <i class="fa-solid fa-plus me-1"></i> Tambah Kategori
            </button>

            <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow rounded-4">
                        @csrf

                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-0">
                                <label for="category_name" class="form-label fw-medium">Nama Kategori</label>
                                <input type="text" class="form-control" id="category_name" name="name" required>
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
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Stok</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-secondary fw-medium">1</td>
                            <td class="fw-semibold">Kategori A</td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border">10</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal" data-bs-target="#modalEditKategori">
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
                <div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4">

                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold" id="modalEditKategoriLabel">Edit
                                    Kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-0">
                                    <label for="edit_category_name" class="form-label fw-medium">Nama
                                        Kategori</label>
                                    <input type="text" class="form-control" id="edit_category_name" name="name" value=""
                                        required>
                                </div>
                            </div>

                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light rounded-pill px-4"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="" class="btn btn-dark rounded-pill px-4 fw-semibold">Simpan
                                    Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>