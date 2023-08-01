<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\GownPackageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GownPackageController as FrontendGownPackageController;
use App\Http\Controllers\BlogController as FrontendBlogController;
use App\Http\Controllers\BookingController as FrontendBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Inilah tempat di mana Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini akan dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buat sesuatu yang luar biasa!
|
*/

Auth::routes(['register' => false]);

// Admin Routes
Route::group(['middleware' => ['is_admin', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Booking Routes
    Route::get('bookings/export-pdf', [BookingController::class, 'exportPdf'])->name('bookings.exportPdf');
    Route::get('bookings/getData', [BookingController::class, 'getData'])->name('bookings.getData');
    Route::resource('bookings', BookingController::class);

    // Gown Package Routes
    Route::get('gown_packages/getData', [GownPackageController::class, 'getData'])->name('gown_packages.getData');
    Route::resource('gown_packages', GownPackageController::class);
    Route::resource('gown_packages.galleries', GalleryController::class)->except(['create', 'index', 'show']);

    // Route for getting data for DataTables
    Route::get('categories/getData', [CategoryController::class, 'getData'])->name('categories.getData');
    // Category Routes
    Route::resource('categories', CategoryController::class)->except('show');

    // Route for getting data for DataTables
    Route::get('blogs/getData', [BlogController::class, 'getData'])->name('blogs.getData');
    // Blog Routes
    Route::resource('blogs', BlogController::class);

    // User Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('gown-packages', [FrontendGownPackageController::class, 'index'])->name('gown_package.index');
Route::get('gown-packages/{gown_package:slug}', [FrontendGownPackageController::class, 'show'])->name('gown_package.show');
Route::get('blogs', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('blogs/{blog:slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
Route::get('blogs/category/{category:slug}', [FrontendBlogController::class, 'category'])->name('blog.category');
Route::get('contact', function () {
    return view('contact');
})->name('contact');
Route::post('booking', [FrontendBookingController::class, 'store'])->name('booking.store');
