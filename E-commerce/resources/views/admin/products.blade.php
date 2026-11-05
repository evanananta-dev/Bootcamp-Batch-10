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
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold" id="modalTambahProdukLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label fw-medium">Nama Produk</label>
                                    <input type="text" class="form-control" id="product_name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="product_category" class="form-label fw-medium">Kategori</label>
                                    <select class="form-select" id="product_category" name="product_category_id"
                                        required>
                                        <option value="" disabled selected>Pilih kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="product_price" class="form-label fw-medium">Harga</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control" id="product_price" name="price"
                                                min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="product_stock" class="form-label fw-medium">Stok</label>
                                        <input type="number" class="form-control" id="product_stock" name="stock"
                                            min="0" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="product_description" class="form-label fw-medium">Deskripsi</label>
                                    <textarea class="form-control" id="product_description" name="description"
                                        rows="3"></textarea>
                                </div>

                                <div class="mb-0">
                                    <label for="product_image" class="form-label fw-medium">Gambar</label>
                                    <input type="file" class="form-control" id="product_image" name="image"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light rounded-pill px-4"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show mb-0" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-4 alert-dismissible fade show mb-0" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 alert-dismissible fade show mb-0" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>{{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif
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
                        @foreach ($products as $product)
                            <tr>
                                <td class="text-secondary fw-medium">{{ $product->id }}</td>
                                <td>
                                    <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width: 60px; height: 60px;">
                                        <img src="{{ Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}"
                                            class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td class="text-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="text-secondary small d-inline-block text-truncate"
                                        style="max-width: 250px;">
                                        {{ $product->description }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $product->stock }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal" data-bs-target="#modalEditProduk{{ $product->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($products as $product)
                    <div class="modal fade" id="modalEditProduk{{ $product->id }}" tabindex="-1"
                        aria-labelledby="modalEditProdukLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow rounded-4">
                                <form action="{{route('products.update', $product->id)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold" id="modalEditProdukLabel{{ $product->id }}">Edit
                                            Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-medium">Nama Produk</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $product->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category{{ $product->id }}"
                                                class="form-label fw-medium">Kategori</label>
                                            <select class="form-select" id="category{{ $product->id }}"
                                                name="product_category_id" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @selected($product->product_category_id == $category->id)>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label for="price" class="form-label fw-medium">Harga</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        value="{{ $product->price }}" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label for="stock" class="form-label fw-medium">Stok</label>
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    value="{{ $product->stock }}" min="0" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-medium">Deskripsi</label>
                                            <textarea class="form-control" id="description" name="description"
                                                rows="3">{{ $product->description }}</textarea>
                                        </div>

                                        <div class="mb-0">
                                            <label for="image{{ $product->id }}"
                                                class="form-label fw-medium">Thumbnail</label>
                                            <div class="mb-2">
                                                <div class="bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center flex-shrink-0"
                                                    style="width: 60px; height: 60px;">
                                                    <img src="{{ Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}"
                                                        class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                                                </div>
                                            </div>
                                            <input type="file" class="form-control" id="image{{ $product->id }}"
                                                name="image" accept="image/*">
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
                @endforeach
            </div>
            <div class="col-12 mt-4">
                @if ($products instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>