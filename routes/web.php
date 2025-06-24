<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Middleware\LocaleMiddleware;  // تأكد من المسار الصحيح

// راوت تغيير اللغة (ما يحتاج ميدلوير)
Route::get('/lang/{lang}', function ($lang) {
    if (! in_array($lang, ['ar','en'])) {
        abort(404);
    }
    session(['locale' => $lang]);
    return redirect()->back();
})->name('locale.switch');

// مجموعة راوتات تطبّق عليها تبديل اللغة
Route::middleware([LocaleMiddleware::class])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/categories', [PageController::class, 'categories'])->name('categories');
    Route::get('/categories/{id}/subcategories', [PageController::class, 'subcategories'])
         ->name('subcategories');
    Route::get('/subcategories/{id}/products', [PageController::class, 'products'])
         ->name('products');
    Route::get('/products/{id}', [PageController::class, 'productDetails'])
         ->name('productDetails');
         Route::get('/features', [PageController::class, 'features'])
     ->name('features');

    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // مسار API للبحث لتجنب مشاكل CORS
    Route::get('/api/search', [PageController::class, 'searchProducts'])->name('api.search');
});
