<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::controller(AuthController::class)->middleware(['guest'])->group(function () {
    Route::get('/login', 'loginView')->name('login.view');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'registerView')->name('register.view');
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth')->withoutMiddleware('guest');
});

Route::middleware(['auth'])->group(function () {
    /* Dashboard */

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    /* Colocation */

    Route::prefix('colocation')->controller(ColocationController::class)->as('colocation.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{colocation}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::delete('/leave/{colocation}', 'leave')->name('leave')->middleware('colocation:Member');
        Route::delete('/{colocation}', 'destroy')->name('destroy')->middleware('colocation:Owner');

        /* Colocation Category */

        Route::prefix('category')->middleware('colocation:Owner')->controller(CategoryController::class)->as('category.')->group(function () {
            Route::get('/{colocationId}', 'index')->name('index');
            Route::post('/{colocationId}', 'store')->name('store');
            Route::put("/{category}", 'update')->name('update');
            Route::delete('/{category}', 'destroy')->name('destroy');
        });

        /* Members */

        Route::get('/{colocation}/members', 'members')->name('members');
        Route::post('/{colocation}/{colocationMember}/remove', 'removeMember')->name('removeMember')->middleware('colocation:Owner');

        /* Expense Detail */

        Route::put('/{expenseDetail}', 'markPaid')->name('detail.mark-paid');
    });

    /* Invitation Routes */

    Route::prefix('invitation')->controller(InvitationController::class)->as('invite.')->group(function () {
        Route::get('/invalid', 'invalid')->name('invalid')->withoutMiddleware('auth');
        Route::get('/accept/{colocationId}', 'accept')->name('accept');
        Route::get('/reject', 'reject')->name('reject');
        Route::get('/conflict', 'conflict')->name('conflict');
        Route::get('/success/{colocationId}', 'success')->name('success');
        Route::post('/invite/{colocationId}', 'invite')->name('invite')->middleware('colocation:Owner');
        Route::get('/validate/{tokenValue}', 'validateToken')->name('validate')->withoutMiddleware('auth');
        Route::post('/confirm/{colocationId}', 'confirm')->name('confirm');
        Route::post('/refuse', 'refuse')->name('refuse');
    });

    /* Expense Routes */

    Route::prefix('expense')->controller(ExpenseController::class)->as( 'expense.')->group(function () {
        Route::post('/', 'store')->name('store');
        Route::put('/{expense}', 'update')->name('update');
        Route::delete('/{expense}', 'destroy')->name('destroy');
    });
});
