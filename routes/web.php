<?php

use App\Http\Controllers\NormalView\IndexController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AuthIndexController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestEnrollmentController;
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

Route::get('/', [PageController::class, 'index']);
Route::get('/about-us', [PageController::class, 'about']);
Route::get('/contact-us', [PageController::class, 'contact']);
Route::put('/contact-us', [PageController::class, 'sendFeedback'])->name('feedback');
Route::get('/travel-and-tours', [IndexController::class, 'travelAndTours']);
Route::get('/travel-and-tours/results/search', [IndexController::class, 'searchPost'])->name('travels.and.tours.search');

Route::get('/login', [AuthIndexController::class, 'loginPage']);
Route::post('/login', [AuthIndexController::class, 'login'])->name('login');

Route::get('/register', [AuthIndexController::class, 'registerPage']);
Route::put('/register', [AuthIndexController::class, 'register'])->name('register');
Route::get('/verification/{user}/{token}', [AuthIndexController::class, 'verification']);

Route::get('/category/{category}', [IndexController::class, 'categoryList']);


Route::get('/logout', [AuthIndexController::class, 'logout']);

Route::middleware(['auth', 'verified'])->group(function () {

    //admin permission route
    Route::middleware('can:manage-all')->group(function () {
        Route::get('/admin/dashboard', [AdminIndexController::class, 'adminDashboard']);

        Route::get('/admin/users/result/search', [AdminPageController::class, 'search'])->name('admin.users.search');

        Route::get('/admin/users', [AdminPageController::class, 'userList']);
        Route::get('/admin/users/create', [AdminPageController::class, 'createUser']);
        Route::put('/admin/users/create', [AdminPageController::class, 'create'])->name('admin.user.create');
        Route::get('/admin/users/update/{user}', [AdminPageController::class, 'updateUser']);
        Route::put('/admin/users/update/{user}', [AdminPageController::class, 'update'])->name('admin.user.update');
        Route::delete('/admin/users/{user}', [AdminPageController::class, 'delete'])->name('admin.user.delete');

        Route::get('/admin/logs', [LogController::class, 'index'])->name('logs.index');

        Route::get('/admin/feedbacks', [AdminIndexController::class, 'feedbacks']);

        Route::get('/admin/categories', [CategoryController::class, 'categories']);
        Route::get('/admin/categories/create', [CategoryController::class, 'createCategory']);
        Route::put('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/admin/categories/update/{category}', [CategoryController::class, 'updateCategory']);
        Route::put('/admin/categories/update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/admin/categories/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('/admin/categories/result/search', [CategoryController::class, 'searchCategory'])->name('admin.category.search');

        Route::get('/admin/posts', [PostController::class, 'index']);
        Route::get('/admin/posts/create', [PostController::class, 'createPost']);
        Route::put('/admin/posts/create', [PostController::class, 'store'])->name('admin.posts.create');
        Route::get('/admin/posts/update/{post}', [PostController::class, 'updatePost']);
        Route::put('/admin/posts/update/{post}', [PostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/admin/posts/{post}', [PostController::class, 'delete'])->name('admin.posts.delete');
        Route::get('/admin/posts/result/search', [PostController::class, 'searchPost'])->name('admin.posts.search');

        Route::get('/admin/bookings', [BookingController::class, 'index']);
        Route::get('/admin/bookings/discount', [BookingController::class, 'createBooking']);
        Route::put('/admin/bookings/create', [BookingController::class, 'store'])->name('admin.bookings.create');
        Route::get('/admin/bookings/update/{booking}', [BookingController::class, 'updateBooking']);
        Route::put('/admin/bookings/update/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
        Route::delete('/admin/bookings/{booking}', [BookingController::class, 'checkouted'])->name('admin.bookings.checkout');
        Route::get('/admin/bookings/result/search', [BookingController::class, 'searchBooking'])->name('admin.bookings.search');

        Route::get('/get-random-name', [BookingController::class, 'getRandomName']);
    });

    //user permission route
    Route::middleware('can:manage-posts')->group(function () {
        Route::get('/bookings', [IndexController::class, 'bookings']);
        Route::get('/confirm-booking/{post}', [IndexController::class, 'confirmBooking']);
        Route::put('/confirm-booking/{post}', [IndexController::class, 'bookingCreate'])->name('create.booking');
        Route::delete('/bookings/{booking}', [IndexController::class, 'cancelled'])->name('bookings.cancel');
    });

    Route::get('/send-testenrollment', [TestEnrollmentController::class, 'sendTestNotification']);
});
Route::get('/sendmail', [EmailController::class, 'sendEmail']);
