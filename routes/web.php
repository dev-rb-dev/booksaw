<?php

use App\Livewire\RTL;
use Guzzl\Middleware;
use App\Livewire\Tables;
use App\Livewire\Billing;
use App\Livewire\Profile;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Livewire\BookManage;
use App\Livewire\StaticSignIn;
use App\Livewire\StaticSignUp;
use App\Livewire\Auth\Register;
use App\Livewire\Notifications;
use App\Livewire\VirtualReality;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Livewire\ExampleLaravel\UserProfile;
use App\Livewire\ExampleLaravel\UserManagement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('dashboard', function(){
    if( auth()->user()->role == 'admin'){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('user.dashboard');
    }
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');


Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::get('user-profile', UserProfile::class)->middleware('auth')->name('user-profile');
Route::get('user-management', UserManagement::class)->middleware('auth')->name('user-management');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('billing', Billing::class)->name('billing');
Route::get('profile', Profile::class)->name('profile');
Route::get('tables', Tables::class)->name('tables');
Route::get('books', BookManage::class)->name('books');
Route::get('notifications', Notifications::class)->name("notifications");
Route::get('virtual-reality', VirtualReality::class)->name('virtual-reality');
Route::get('static-sign-in', StaticSignIn::class)->name('static-sign-in');
Route::get('static-sign-up', StaticSignUp::class)->name('static-sign-up');
Route::get('rtl', RTL::class)->name('rtl');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
Route::get('dashboard',[HomeController::class, 'dashboard'])->name('user.dashboard');
Route::get('orders',[OrderController::class, 'index'])->name('orders');


Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('cart/count', [CartController::class, 'cartCount'])->name('cart.count');
Route::get('cart/load', [CartController::class, 'cartLoad'])->name('cart.load');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::put('cart/update', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart/{cart}', [CartController::class, 'destroy'])->name('remove.from.cart');

Route::post('add-to-order', [OrderController::class, 'addToOrder'])->name('add.to.order');
});
