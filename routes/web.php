<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Manager\StockController;
// TAMBAHKAN IMPORT UNTUK MANAGER/STAFF DASHBOARD
use App\Http\Controllers\Manager\DashboardController; // Untuk Role Manager
use App\Http\Controllers\Staff\StaffDashboardController; // Untuk Role Staff (Perlu dibuat)


/*
|--------------------------------------------------------------------------
| Public Routes & Authentication View/Action Routes
|--------------------------------------------------------------------------
*/

// Mengarahkan root URL ke halaman login jika belum login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect()->route('login');
});

// ROUTE AUTHENTIKASI (Views dan Proses)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard & Redirection Route
|--------------------------------------------------------------------------
*/
// PENTING: Middleware 'auth' dalam huruf kecil
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'manager') {
            return redirect()->route('manager.dashboard');
        } elseif ($role === 'staff') {
            return redirect()->route('staff.dashboard');
        }
        return view('dashboard'); 
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Admin Group Routes (Role: admin)
|--------------------------------------------------------------------------
*/
// PENTING: Middleware 'auth' dalam huruf kecil
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('stock', [ReportController::class, 'stockReport'])->name('stock');
        Route::get('movement', [ReportController::class, 'movementReport'])->name('movement');
    });
});


/*
|--------------------------------------------------------------------------
| Manager Group Routes (Role: manager) - Fokus Stok Kontrol
|--------------------------------------------------------------------------
*/
// Manager mendapatkan semua hak akses ke StockController
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    
    // MENGGUNAKAN CONTROLLER BARU
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

    Route::get('stock-in', [StockController::class, 'indexIn'])->name('stock.in');
    Route::post('stock-in', [StockController::class, 'storeIn'])->name('stock.in.store');
    
    Route::get('stock-out', [StockController::class, 'indexOut'])->name('stock.out');
    Route::post('stock-out', [StockController::class, 'storeOut'])->name('stock.out.store');
});


/*
|--------------------------------------------------------------------------
| Staff Group Routes (Role: staff) - Fokus Tugas Operasional
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    
    // Dashboard Staff (Fokus pada Daftar Tugas)
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard'); 

    // Asumsi Staff hanya bisa mengakses konfirmasi, bukan input data
    Route::get('stock-in/confirm', [StockController::class, 'confirmIn'])->name('stock.in.confirm');
    Route::post('stock-in/process/{id}', [StockController::class, 'processIn'])->name('stock.in.process');
    
    Route::get('stock-out/confirm', [StockController::class, 'confirmOut'])->name('stock.out.confirm');
    Route::post('stock-out/process/{id}', [StockController::class, 'processOut'])->name('stock.out.process');
});