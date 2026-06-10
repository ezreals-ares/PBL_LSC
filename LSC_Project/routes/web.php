<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Models\Outlet;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

// Landing page — pass services and reviews from DB
Route::get('/', function () {
    $services = Service::orderBy('service_name')->get();
    $reviews  = Review::with('user')
        ->where('rating', '>=', 4)
        ->latest()
        ->take(6)
        ->get();
    $outlets  = Outlet::with('operationalHours')->get();
    return view('home.index', compact('services', 'reviews', 'outlets'));
})->name('landing');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin');
    }
    return redirect()->route('order.history');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar');
});

// ─── Customer Feature Routes ───────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Order routes — hanya bisa buat pesanan jika profil (phone+address) sudah lengkap
    Route::get('/pesan', [OrderController::class, 'create'])->name('order.create')->middleware('profile.complete');
    Route::post('/pesan', [OrderController::class, 'store'])->name('order.store')->middleware('profile.complete');
    Route::get('/pesanan', [OrderController::class, 'history'])->name('order.history');
    Route::get('/pesanan/{order:order_id}', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/pesanan/{order:order_id}/batal', [OrderController::class, 'cancel'])->name('order.cancel');

    // Payment routes
    Route::get('/pembayaran/{order:order_id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/pembayaran/{order:order_id}', [PaymentController::class, 'store'])->name('payment.store');
    Route::match(['post', 'put'], '/pembayaran/{order:order_id}/upload', [PaymentController::class, 'upload'])->name('payment.upload');

    // Review routes
    Route::get('/ulasan/{order:order_id}/buat', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/ulasan/{order:order_id}', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/ulasan/{order:order_id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/ulasan/{order:order_id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/ulasan/{order:order_id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

require __DIR__.'/auth.php';
