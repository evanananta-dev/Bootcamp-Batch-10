// Helper gambar placeholder: warna gelap untuk varian Pro, terang untuk varian Air
function placeholderImage(label, isPro) {
    const bg = isPro ? '111827' : 'e5e7eb';
    const fg = isPro ? 'ffffff' : '111827';
    return `https://placehold.co/300x300/${bg}/${fg}?text=${encodeURIComponent(label)}`;
}

// Default dataset: AppPhone, AppBook, AppTab
const defaultProducts = [
    // Phone
    { name: 'AppPhone X12 Pro', price: 21999000, category: 'Phone',  image: placeholderImage('AppPhone X12 Pro', true) },
    { name: 'AppPhone X12 Air', price: 15999000, category: 'Phone',  image: placeholderImage('AppPhone X12 Air', false) },

    // Laptop
    { name: 'AppBook Pro 14',   price: 28999000, category: 'Laptop', image: placeholderImage('AppBook Pro 14', true) },
    { name: 'AppBook Air 14',   price: 18999000, category: 'Laptop', image: placeholderImage('AppBook Air 14', false) },

    // Tablet
    { name: 'AppTab Pro 10',    price: 10999000, category: 'Tablet', image: placeholderImage('AppTab Pro 10', true) },
    { name: 'AppTab Air 10',    price: 7999000,  category: 'Tablet', image: placeholderImage('AppTab Air 10', false) }
];

// Currency formatter to IDR Rupiah
function formatIDR(amount) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(amount);
}

// Fetch list of products from localStorage or defaults
// Naikkan angka ini setiap kali kamu mengubah defaultProducts
const PRODUCTS_VERSION = '4';

function getProducts() {
    try {
        const stored = localStorage.getItem('apple_products');
        const version = localStorage.getItem('apple_products_version');

        // Kosong atau versi lama -> timpa dengan defaultProducts terbaru
        if (!stored || version !== PRODUCTS_VERSION) {
            localStorage.setItem('apple_products', JSON.stringify(defaultProducts));
            localStorage.setItem('apple_products_version', PRODUCTS_VERSION);
            return defaultProducts;
        }
        return JSON.parse(stored);
    } catch(e) {
        return defaultProducts;
    }
}

// Fetch shopping cart from localStorage
function getCart() {
    try {
        return JSON.parse(localStorage.getItem('apple_cart')) || [];
    } catch(e) {
        return [];
    }
}

// Save shopping cart state
function saveCart(cart) {
    localStorage.setItem('apple_cart', JSON.stringify(cart));
    updateBagCount();
}

// Kosongkan keranjang
function resetCart() {
    if (!confirm('Kosongkan semua isi tas belanja?')) return;

    localStorage.removeItem('apple_cart');
    updateBagCount();
    showToast('Tas belanja telah dikosongkan.');

    // Kalau dipakai di halaman keranjang yang punya fungsi renderCart(), muat ulang tampilannya
    if (typeof renderCart === 'function') renderCart();
}

// Update badge count on cart navbar item
function updateBagCount() {
    const cart = getCart();
    const totalCount = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById('bagBadge');

    if (badge) {
        if (totalCount > 0) {
            badge.style.display = 'inline-block';
            badge.innerText = totalCount;
        } else {
            badge.style.display = 'none';
        }
    }
}

// Display toast alert message
function showToast(message) {
    const toastText = document.getElementById('toastText');
    const toastEl = document.getElementById('cartToast');
    if (toastText && toastEl && window.bootstrap) {
        toastText.innerText = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
}

// Add item to shopping cart (index = posisi produk di array ASLI)
function addToCart(index) {
    const products = getProducts();
    const product = products[index];
    let cart = getCart();

    const existingIndex = cart.findIndex(item => item.name === product.name);
    if (existingIndex > -1) {
        cart[existingIndex].qty += 1;
    } else {
        cart.push({
            name: product.name,
            price: product.price,
            image: product.image,
            qty: 1
        });
    }

    saveCart(cart);
    showToast(`${product.name} telah ditambahkan ke tas belanja.`);
}

// Render produk + search + filter kategori + sort ke #product-list
function renderProducts() {
    const allProducts = getProducts();
    const container = document.getElementById('product-list');
    const countEl = document.getElementById('product-count');
    const emptyEl = document.getElementById('empty-message');

    if (!container) return;

    const keyword = document.getElementById('search-input').value.toLowerCase().trim();
    const category = document.getElementById('category-filter').value;
    const sort = document.getElementById('sort-filter').value;

    // Simpan index asli supaya addToCart tetap mengambil produk yang benar
    let list = allProducts.map((p, i) => ({ ...p, originalIndex: i }));

    list = list.filter(p =>
        p.name.toLowerCase().includes(keyword) &&
        (category === 'all' || p.category === category)
    );

    if (sort === 'price-low-high') list.sort((a, b) => a.price - b.price);
    if (sort === 'price-high-low') list.sort((a, b) => b.price - a.price);

    container.innerHTML = list.map(product => `
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-1 rounded-4 shadow-sm text-center p-3">
                <img src="${product.image}" class="card-img-top rounded-3 mb-3 mx-auto" alt="${product.name}" style="height: 220px; object-fit: cover;" onerror="this.src='https://placehold.co/300x300/eee/333?text=Product'">
                <div class="card-body d-flex flex-column justify-content-between p-2">
                    <div>
                        <span class="badge bg-secondary mb-2">${product.category || 'Aksesoris'}</span>
                        <h4 class="card-title fw-bold fs-5 mb-2">${product.name}</h4>
                        <p class="text-primary fw-semibold fs-5 mb-3">${formatIDR(product.price)}</p>
                    </div>
                    <button class="btn btn-primary rounded-pill w-100 py-2 mt-2" onclick="addToCart(${product.originalIndex})">
                        <i class="fa-solid fa-bag-shopping me-2"></i>Tambah ke Tas
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    if (countEl) countEl.innerText = `${list.length} produk ditemukan`;
    if (emptyEl) emptyEl.classList.toggle('d-none', list.length > 0);
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
    renderProducts();
    updateBagCount();

    document.getElementById('search-input').addEventListener('input', renderProducts);
    document.getElementById('category-filter').addEventListener('change', renderProducts);
    document.getElementById('sort-filter').addEventListener('change', renderProducts);
});