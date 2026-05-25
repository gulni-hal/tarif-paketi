<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Models\Order;

Route::get('/hakkimizda', function () {
    // Veritabanındaki toplam satır sayılarını anlık olarak saydırıyoruz
    $totalProducts = Product::count();
    $totalReviews  = Review::count();
    $totalUsers    = User::count();
    $totalOrders   = Order::count(); // Toplam sipariş sayısı için orders tablosunu sayıyoruz

    // Elde ettiğimiz verileri compact ile about.blade.php şablonuna fırlatıyoruz
    return view('about', compact('totalProducts', 'totalReviews', 'totalUsers', 'totalOrders'));
})->name('about');

Route::get('/', [HomeController::class, 'index']);
Route::get('/urun/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('product.detail');


Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
Route::post('/giris', [AuthController::class, 'login']);

Route::get('/kayit', [AuthController::class, 'showRegister'])->name('register');
Route::post('/kayit', [AuthController::class, 'register']);

Route::post('/sepet/artir/{id}', [\App\Http\Controllers\CartController::class, 'increase'])->name('cart.increase');
Route::post('/sepet/azalt/{id}', [\App\Http\Controllers\CartController::class, 'decrease'])->name('cart.decrease');

Route::post('/sifremi-unuttum', [\App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('password.forgot.post');

Route::post('/cikis', [AuthController::class, 'logout'])->name('logout');
Route::post('/iletisim-gonder', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Kategoriler için özel bağımsız sayfa rotası
Route::get('/kategori/{slug}', [\App\Http\Controllers\HomeController::class, 'category'])->name('category.show');

Route::get('/iletisim', function () {
    return view('contact');
})->name('contact');
Route::get('/misyon-vizyon', function () {
    return view('misyon_vizyon');
})->name('misyon-vizyon');
// Route::get('/hakkimizda', function () {
//     return view('about');
// })->name('about');
Route::post('/urun/{id}/yorum', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
// Sadece giriş yapmış kullanıcıların erişebileceği rotalar
Route::middleware(['auth'])->group(function () {
    Route::post('/sepet/ekle/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/sepet', [CartController::class, 'index'])->name('cart.index');
    Route::post('/sepet/sil/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Ödeme ve Sipariş Rotaları
    Route::get('/odeme', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/siparis-ver', [\App\Http\Controllers\OrderController::class, 'placeOrder'])->name('order.place');
    
    // Kullanıcının siparişlerini takip edeceği sayfa
    Route::get('/siparislerim', [\App\Http\Controllers\OrderController::class, 'myOrders'])->name('orders.index');

    // Sipariş İptal ve Teslim Alma Rotaları
    Route::post('/siparis/iptal/{id}', [\App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('order.cancel');
    Route::post('/siparis/teslim-aldim/{id}', [\App\Http\Controllers\OrderController::class, 'confirmDelivery'])->name('order.deliver');

    // Profil Rotaları
    Route::get('/profil', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profil/guncelle', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/dondur', [\App\Http\Controllers\ProfileController::class, 'deactivate'])->name('profile.deactivate');
});

// Admin Rotaları
Route::middleware([\App\Http\Middleware\IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/siparisler', [\App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/siparis-ilerlet/{id}', [\App\Http\Controllers\AdminController::class, 'advanceOrderStatus'])->name('admin.order.advance');

    Route::post('/admin/review/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteReview'])->name('admin.review.delete');

    // Admin Ürün Rotaları
    Route::get('/urunler', [\App\Http\Controllers\AdminController::class, 'products'])->name('admin.products');
    Route::get('/urun-ekle', [\App\Http\Controllers\AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/urun-ekle', [\App\Http\Controllers\AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::post('/urun-sil/{id}', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::get('/urun-duzenle/{id}', [\App\Http\Controllers\AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::post('/urun-guncelle/{id}', [\App\Http\Controllers\AdminController::class, 'updateProduct'])->name('admin.product.update');

    // Admin Kullanıcı Yönetimi Rotaları
    Route::get('/kullanicilar', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/kullanici-durum/{id}', [\App\Http\Controllers\AdminController::class, 'toggleUserStatus'])->name('admin.user.toggle');
    Route::post('/kullanici-sil/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.user.delete');

    // Admin Mesaj Yönetimi Rotaları
    Route::get('/mesajlar', [\App\Http\Controllers\AdminController::class, 'messages'])->name('admin.messages');
    Route::post('/mesaj-sil/{id}', [\App\Http\Controllers\AdminController::class, 'deleteMessage'])->name('admin.message.delete');
});
