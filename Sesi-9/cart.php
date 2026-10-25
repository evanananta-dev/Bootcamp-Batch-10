<?php
require 'koneksi.php';
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Store - Official Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body class="bg-light text-dark">
  <nav class="navbar navbar-expand-md sticky-top py-2 bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand text-dark d-flex align-items-center gap-2 fw-semibold fs-6" href="index.php">
        <i class="fa-brands fa-xl text-dark"></i> <span>AppStore</span>
      </a>
    </div>
  </nav>

  <section>
    <?php if (empty($products)): ?>
      <div class="col-12 text-center py-5">
        <div class="text-secondary">
          <i class="fa-solid fa-box-open fa-3x mb-3 text-muted"></i>
          <p class="mb-0">Belum ada produk yang tersedia.</p>
        </div>
      </div>
    <?php endif; ?>
    </div>
    </div>
  </section>

  <footer class="bg-light py-4 text-secondary small border-top">
    <div class="container">
      <p class="mb-0 text-center text-md-start">&copy; <?= date('Y') ?> Store.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>