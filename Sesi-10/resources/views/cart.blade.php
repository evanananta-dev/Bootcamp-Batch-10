@extends('layout')
@section('title', 'Tas Belanja')
@section('content')
    <main class="py-5 bg-white">
      <div class="container py-4">
        <h1 class="fw-bold mb-4">Tas Belanja</h1>

        <!-- Tampilan tas kosong (hapus komentar ini dan hapus bagian di atas jika tas kosong) -->
        <div class="text-center py-5">
          <h4>Tas belanja kosong</h4>
          <p class="text-secondary">Tambahkan produk dari halaman utama.</p>
          <a href="." class="btn btn-primary rounded-pill px-4">Mulai Belanja</a>
        </div>
      </div>
    </main>
@endsection