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
                <option value="Phone">Phone</option>
                <option value="Laptop">Laptop</option>
                <option value="Tablet">Tablet</option>
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
            <!-- Produk 1 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Phone</span
                  >
                  <h5 class="card-title">AppPhone 15</h5>
                  <p class="card-text text-secondary small">
                    Layar 6,1 inci, kamera ganda, dan baterai tahan seharian.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 12.999.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>

            <!-- Produk 2 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Phone</span
                  >
                  <h5 class="card-title">AppPhone Pro</h5>
                  <p class="card-text text-secondary small">
                    Kamera tiga lensa dengan chip tercepat di kelasnya.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 18.999.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>

            <!-- Produk 3 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Laptop</span
                  >
                  <h5 class="card-title">AppBook Air</h5>
                  <p class="card-text text-secondary small">
                    Laptop tipis dan ringan untuk kuliah dan kerja harian.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 16.499.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>

            <!-- Produk 4 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Laptop</span
                  >
                  <h5 class="card-title">AppBook Pro</h5>
                  <p class="card-text text-secondary small">
                    Performa tinggi untuk pengolahan data dan pemrograman.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 29.999.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>

            <!-- Produk 5 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Tablet</span
                  >
                  <h5 class="card-title">AppPad</h5>
                  <p class="card-text text-secondary small">
                    Tablet 10 inci untuk menggambar, membaca, dan menonton.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 7.999.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>

            <!-- Produk 6 -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border-0 shadow-sm">
                <div
                  class="bg-light d-flex align-items-center justify-content-center text-secondary"
                  style="height: 200px"
                >
                  Gambar Produk
                </div>
                <div class="card-body d-flex flex-column">
                  <span class="badge text-bg-secondary align-self-start mb-2"
                    >Tablet</span
                  >
                  <h5 class="card-title">AppPad Pro</h5>
                  <p class="card-text text-secondary small">
                    Layar 12,9 inci dengan dukungan pena untuk kerja kreatif.
                  </p>
                  <p class="fw-bold mt-auto mb-3">Rp 14.999.000</p>
                  <button type="button" class="btn btn-primary rounded-pill">
                    Tambah ke Tas
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection