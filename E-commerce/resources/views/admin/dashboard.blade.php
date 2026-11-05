<x-app-layout>
    <div class="container py-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="fw-bold fs-2 text-dark mb-1">Dashboard Admin</h1>
                <p class="text-secondary small mb-0">Ringkasan statistik dan performa toko Anda.</p>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <main class="container pb-5 flex-grow-1">

        <!-- Stat Cards Row -->
        <div class="row g-3 mb-4">
            <!-- Total Produk -->
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary small mb-1 fw-medium">Total Produk</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $JumlahProduk }}</h3>
                        </div>
                        <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center p-3"
                            style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-box fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary small mb-1 fw-medium">Total Kategori</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $JumlahKategori }}</h3>
                        </div>
                        <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center p-3"
                            style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-layer-group fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary small mb-1 fw-medium">Jumlah Klik</p>
                            <h3 class="fw-bold text-dark mb-0">{{ number_format($JumlahklikProduk, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center p-3"
                            style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-arrow-pointer fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary small mb-1 fw-medium">Total User</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $JumlahUser }}</h3>
                        </div>
                        <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center p-3"
                            style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-users fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>