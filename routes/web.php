<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuoteController;
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
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Fruits management
        Route::resource('fruits', \App\Http\Controllers\Admin\FruitController::class);
        
        // Categories management
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        
        // Quote requests management
        Route::resource('quotes', \App\Http\Controllers\Admin\QuoteRequestController::class)->except(['create', 'store', 'edit', 'update']);
        Route::put('quotes/{quoteRequest}/status', [\App\Http\Controllers\Admin\QuoteRequestController::class, 'updateStatus'])->name('quotes.update-status');
    });
});

require __DIR__.'/auth.php';
