<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\TrackingController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - IJCS (Indra Jaya Computer Service)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Bebas Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman Utama Publik (Landing Page Toko)
Route::get('/', [TrackingController::class, 'home'])->name('public.home');

// Form Pencarian Nomor Tiket dari Landing Page
Route::post('/track/search', [TrackingController::class, 'search'])->name('public.track.search');

// Route Tracking Servis Pelanggan via QR Code / Token Direct
Route::get('/track/{token}', [TrackingController::class, 'track'])->name('public.track');

// Redirect /home ke Dashboard Admin
Route::redirect('/home', '/admin/dashboard');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
| Endpoint diubah ke /portal-ijcs untuk keamanan (Security through Obscurity)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/portal-ijcs', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/portal-ijcs', [LoginController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Session
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Internal Admin & Operational Panel
| Shared Access: Admin, Owner, Teknisi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':admin,owner,teknisi'])
    ->prefix('admin')
    ->group(function () {
        
        // 1. Dashboard Utama Analytics
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // 2. Modul Tiket Servis
        Route::get('services/{service}/print-receipt', [ServiceController::class, 'printReceipt'])
            ->name('services.print-receipt');

        // Cetak Nota Pelunasan / Invoice Lunas
        Route::get('services/{service}/print-invoice', [ServiceController::class, 'printInvoice'])
            ->name('services.print-invoice');
            
        Route::patch('services/{service}/update-status', [ServiceController::class, 'updateStatus'])
            ->name('services.update-status');
            
        Route::resource('services', ServiceController::class);

        /*
        |--------------------------------------------------------------------------
        | Restricted Access: Admin & Owner Only (Kasir & Transaksi)
        |--------------------------------------------------------------------------
        */
        Route::middleware(CheckRole::class . ':admin,owner')->group(function () {
            Route::post('services/{service}/process-payment', [ServiceController::class, 'processPayment'])
                ->name('services.process-payment');
        });

        /*
        |--------------------------------------------------------------------------
        | Restricted Access: Owner Only (Manajemen & Laporan)
        |--------------------------------------------------------------------------
        */
        Route::middleware(CheckRole::class . ':owner')->group(function () {
            // Laporan Keuangan
            Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
            Route::get('/reports/print', [ReportController::class, 'print'])->name('admin.reports.print');

            // Modul Manajemen Staf & Users
            Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
            Route::resource('users', UserController::class, ['as' => 'admin']);
        });

    });