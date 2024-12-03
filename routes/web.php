<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});
Route::get('/', function () {
    return view('home.index_content');
});
//  for pages
Route::get('/index', [HomeController::class, 'index']);
Route::get('/index', [HomeController::class, 'index_content']);
Route::get('/shop', [PagesController::class, 'shop']);
Route::get('/shop', [PagesController::class, 'shop_content']);
Route::get('/contact', [PagesController::class, 'contact']);
Route::get('/contact', [PagesController::class, 'contact_content']);

// for crud module
Route::name('product.')->prefix('product')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('update', [ProductController::class, 'update'])->name('update');
    Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
