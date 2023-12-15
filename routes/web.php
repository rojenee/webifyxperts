<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\LaundryController as CustomerLaundryController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\LaundryController as StaffLaundryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\BookingController as StaffBookingController;
use App\Http\Controllers\Staff\ReportController;
use App\Http\Controllers\TransactionController;
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


// Login and Registration Routes
Route::group(['middleware' => 'guest'], function () {
    Route::group(['as' => 'guest.'], function () {
        Route::get('/login', [AuthenticationController::class, 'loginPage'])
            ->name('login');
        Route::get('/register', [AuthenticationController::class, 'registerPage'])
            ->name('register');
        Route::get('/homepage', [AuthenticationController::class, 'homepage'])
            ->name('homepage');
    });

    Route::group(['as' => 'auth.'], function () {
        Route::post('/login', [AuthenticationController::class, 'authLogin'])->name('login');
        Route::post('/register', [AuthenticationController::class, 'authRegister'])->name('register');
    });
});

Route::get('/homepage', [TransactionController::class, 'info'])->name('info');
// Route::get('/footer', [TransactionController::class, 'editFooter'])->name('footer.edit');
Route::put('/footer/update', [TransactionController::class, 'updateFooter'])->name('footer.update');
// Routes for Customer
Route::group(
    ['middleware' => ['auth', 'can:customer'], 'prefix' => 'customer', 'as' => 'customer.'],
    function () {
        // Routes for Customer Dashboard
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
            ->name('dashboard');

        // Route for Customer Profile
        Route::get('/profile', [ProfileController::class, 'customerProfilePage'])
            ->name('profile');

        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])
            ->name('update-profile');

        // Routes Resources for Laundries
        Route::resource('laundries', CustomerLaundryController::class);

        // Routes Resources for Bookings
        Route::resource('bookings', CustomerBookingController::class);

        // Routes for Orders
        Route::post('/place-order/{laundry}', [OrderController::class, 'placeOrder'])->name('placeOrder');
        Route::put('/update-order/{order}', [OrderController::class, 'updateOrder'])->name('updateOrder');
        Route::get('/view-order/{laundry}', [OrderController::class, 'viewOrder'])->name('viewOrder');

        // Routes for Transaction
        Route::get('/transaction-logs/{user}', [TransactionController::class, 'index'])
            ->name('transaction-logs');

        // Routes for Payment
        Route::get('/view-payment', [PaymentController::class, 'viewPayment'])
            ->name('viewPayment');
        Route::get('/create-payment', [PaymentController::class, 'createPayment'])
            ->name('createPayment');
        Route::post('/store-payment', [PaymentController::class, 'storePayment'])
            ->name('storePayment');
        Route::delete('/destroy-payment/{payment}', [PaymentController::class, 'destroyPayment'])
            ->name('destroyPayment');
    }
);

Route::group(
    ['middleware' => ['auth', 'can:staff'], 'prefix' => 'staff', 'as' => 'staff.'],
    function () {
        
        Route::post('/footer/update', [InfoController::class, 'update'])->name('footer.update');

        // Routes for Staff Dashboard
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])
            ->name('dashboard');

        // Route for Staff Profile
        Route::get('/profile', [ProfileController::class, 'staffProfilePage'])
            ->name('profile');

        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])
            ->name('update-profile');

        //Route for Footer
        // Route::get('/footer', [ProfileController::class, 'staffFooterPage']);
    
        Route::get('/footer', [ProfileController::class, 'staffFooterPage'])->name('footer');
        // Routes Resources for Laundries
        Route::resource('laundries', StaffLaundryController::class);

        // Routes Resources for Bookings
        Route::resource('bookings', StaffBookingController::class);

        // Routes for Orders
        Route::get('/view-order/{laundry?}', [OrderController::class, 'viewOrder'])->name('viewOrder');
        Route::put('/update-order/{order}', [OrderController::class, 'updateOrder'])->name('updateOrder');

        // Routes for Transaction
        Route::get('/transaction-logs/{user?}', [TransactionController::class, 'index'])
            ->name('transaction-logs');

        // Routes for Reports
        Route::get('/reports-view', [ReportController::class, 'reportView'])->name('report-view');
        Route::get('/reports-generate', [ReportController::class, 'reportGenerate'])->name('report-generate');

        // Routes for Payment
        Route::get('/view-payment', [PaymentController::class, 'viewPayment'])
            ->name('viewPayment');
        Route::put('/update-payment/{payment}', [PaymentController::class, 'updatePaymentStatus'])
            ->name('updatePaymentStatus');
        Route::delete('/destroy-payment/{payment}', [PaymentController::class, 'destroyPayment'])
            ->name('destroyPayment');

        Route::get('/dashboard/most-booked-laundry-types', [OrderController::class, 'getMostBookedLaundryTypes'])
            ->name('dashboard.mostBookedLaundryTypes');

        
    }

);

Route::get('/logout', [AuthenticationController::class, 'authLogout'])->middleware('auth')
    ->name('auth.logout');

