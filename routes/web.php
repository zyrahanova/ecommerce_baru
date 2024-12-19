<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Dashboard\CekOngkirController;
use App\Http\Controllers\Dashboard\CheckoutController as DashboardCheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParsingDataController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/galeries', function(){
    return view('dashboard.galeries');
})->name('galeries');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index', ['title' => 'Dashboard']);
    })->name('index');

});

Route::resource('cek-ongkir', CekOngkirController::class)->names('cek-ongkir');
Route::resource('checkout', DashboardCheckoutController::class)->names('checkout'); // Midtrans

Route::resource('profile', ProfileController::class)->only([
    'index', 'update'
])->names('profile');

Route::resource('products', ProductController::class)->only([
    'index', 'store', 'destroy'
])->names('products');

Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::prefix('admin')->group(function() {
    Route::resource('home', HomeController::class);
    Route::resource('product', ProductController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('transaction', TransactionController::class);
});

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('products/{product}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.add_to_cart');

Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);

Route::get('cart', function () {
    $cartItems = CartItem::where('customer_id', auth()->id())->get();
    return view('dashboard.cart.index', compact('cartItems'));
})->name('cart.index');

Route::post('/checkout', [DashboardCheckoutController::class, 'store'])->name('checkout.store');

Route::get('/parse-data', function () {
    return view('parsed-data', ['name' => 'Arzyra Azza Hanova'], ['email' => 'arzyraazzahanova@gmail.com']);
});
