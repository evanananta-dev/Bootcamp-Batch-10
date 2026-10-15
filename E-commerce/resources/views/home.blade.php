@extends('layout')
@section('title', 'Home')
@section('content')
    <section class="bg-black text-white text-center py-5">
      <div class="container py-5">
        <h1 class="display-3 fw-bold mb-1">Jelajahi Produk Kami</h1>
        <div class="d-flex justify-content-center gap-3 mb-5 py-2">
          <a
            href="#store-products"
            class="btn btn-primary rounded-pill px-4 py-2"
            >Pelajari Lebih Lanjut</a
          >
        </div>
      </div>
    </section>

    <!-- Produk -->
    <section id="store-products" class="py-5 bg-white">
      <div class="container py-4">
        <div class="container pb-5">
          <div class="row g-3 mb-4">
            <div class="col-md-5">
              <label for="search-input" class="form-label">Cari produk</label>
              <input
                type="text"
                id="search-input"
                class="form-control"
                placeholder="Contoh: AppPhone"
              />
            </div>

            <div class="col-md-4">
              <label for="category-filter" class="form-label">Kategori</label>
              <select id="category-filter" class="form-select">
                <option value="all">Semua kategori</option>
                <option value="1">Phone</option>
                <option value="2">Laptop</option>
                <option value="3">Tablet</option>
              </select>
            </div>

            <div class="col-md-3">
              <label for="sort-filter" class="form-label">Urutkan harga</label>
              <select id="sort-filter" class="form-select">
                <option value="default">Default</option>
                <option value="price-low-high">Harga: Rendah ke Tinggi</option>
                <option value="price-high-low">Harga: Tinggi ke Rendah</option>
              </select>
            </div>
          </div>

          <p class="text-secondary">Menampilkan 6 produk</p>

          <div class="row g-4">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div>
                  <img src="{{ $product->image}}"
                     class="w-100 object-fit-cover"
                     style="height: 200px"
                     alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >{{ $product->category->name }}</span
                  >
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text text-secondary small">
                    {{ $product->description }}
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-12 mt-4">
            {{ $products->links() }}
        </div>
    </section>
@endsection