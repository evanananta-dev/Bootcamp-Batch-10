@extends('../layouts/layout')
@section('title', 'Tas Belanja')
@section('content')
  <div class="container pb-5">
    <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5">
      <div class="card-body py-4">
        <div class="mb-3 text-secondary opacity-50 fs-1">
          <i class="fa-solid fa-bag-shopping"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">Keranjang Masih Kosong</h3>
        <p class="text-secondary col-md-6 mx-auto mb-4">Belum ada produk yang ditambahkan ke keranjang Anda.</p>
        <a href="/" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold">
          Mulai Belanja
        </a>
      </div>
    </div>
  </div>
@endsection