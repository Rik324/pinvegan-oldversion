<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FruitController as AdminFruitController;
use App\Http\Controllers\Admin\QuoteRequestController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/fruits', [FruitController::class, 'index'])->name('fruits.index');
Route::get('/fruits/{fruit}', [FruitController::class, 'show'])->name('fruits.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Quote request routes
Route::get('/quote', [QuoteController::class, 'index'])->name('quote.index');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::post('/quote/add', [QuoteController::class, 'addToQuote'])->name('quote.add');
Route::put('/quote/update/{id}', [QuoteController::class, 'updateQuoteItem'])->name('quote.update');
Route::delete('/quote/remove/{id}', [QuoteController::class, 'removeFromQuote'])->name('quote.remove');
Route::post('/quote/clear', [QuoteController::class, 'clearQuote'])->name('quote.clear');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Dashboard
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Fruits management
    Route::get('admin/fruits', [AdminFruitController::class, 'index'])->name('admin.fruits.index');
    Route::get('admin/fruits/create', [AdminFruitController::class, 'create'])->name('admin.fruits.create');
    Route::post('admin/fruits', [AdminFruitController::class, 'store'])->name('admin.fruits.store');
    Route::get('admin/fruits/{fruit}', [AdminFruitController::class, 'show'])->name('admin.fruits.show');
    Route::get('admin/fruits/{fruit}/edit', [AdminFruitController::class, 'edit'])->name('admin.fruits.edit');
    Route::put('admin/fruits/{fruit}', [AdminFruitController::class, 'update'])->name('admin.fruits.update');
    Route::delete('admin/fruits/{fruit}', [AdminFruitController::class, 'destroy'])->name('admin.fruits.destroy');
    
    // Categories management
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Quote requests management
    Route::get('admin/quotes', [QuoteRequestController::class, 'index'])->name('admin.quotes.index');
    Route::get('admin/quotes/{quote}', [QuoteRequestController::class, 'show'])->name('admin.quotes.show');
    Route::delete('admin/quotes/{quote}', [QuoteRequestController::class, 'destroy'])->name('admin.quotes.destroy');
    Route::put('admin/quotes/{quote}/status', [QuoteRequestController::class, 'updateStatus'])->name('admin.quotes.update-status');
});

require __DIR__.'/auth.php';
