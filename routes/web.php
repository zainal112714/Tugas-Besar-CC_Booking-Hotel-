 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\GownPackageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GownPackageController as FrontendGownPackageController;
use App\Http\Controllers\BlogController as FrontendBlogController;
use App\Http\Controllers\BookingController as FrontendBookingController;

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

Auth::routes(['register' => false]);

Route::group(['middleware' => ['is_admin','auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // booking
    Route::resource('bookings', BookingController::class)->only(['index', 'destroy']);
    // gown packages
    Route::resource('gown_packages', GownPackageController::class)->except('show');
    Route::resource('gown_packages.galleries', GalleryController::class)->except(['create', 'index','show']);
    // categories
    Route::resource('categories', CategoryController::class)->except('show');

});


Route::get('/', [HomeController::class, 'index'])->name('homepage');
// gown packages
Route::get('gown-packages',[FrontendGownPackageController::class, 'index'])->name('gown_package.index');
Route::get('gown-packages/{gown_package:slug}',[FrontendGownPackageController::class, 'show'])->name('gown_package.show');
// blogs
Route::get('blogs', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('blogs/{blog:slug}', [FrontendBlogController::class, 'show'])->name('blog.show');
