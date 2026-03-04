<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController; // ✅ TAMBAH INI
use App\Http\Controllers\SiswaPengaduanController;
use App\Http\Controllers\AdminPengaduanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| SISWA ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['loginManual', 'roleManual:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        // ✅ FIX UTAMA (WAJIB)
        // sebelumnya AdminController ❌
        Route::get('/dashboard',
            [SiswaController::class, 'dashboard']
        )->name('dashboard');


        /*
        |-------------------------
        | Pengaduan Siswa
        |-------------------------
        */
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {

            Route::get('/', [SiswaPengaduanController::class, 'index'])->name('index');

            Route::get('/create', [SiswaPengaduanController::class, 'create'])->name('create');

            Route::post('/store', [SiswaPengaduanController::class, 'store'])->name('store');

            Route::get('/{id}', [SiswaPengaduanController::class, 'show'])->name('show');

            Route::delete('/delete/{id}', [SiswaPengaduanController::class, 'delete'])
                ->name('delete');
        });
    });



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['loginManual', 'roleManual:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |-------------------------
        | Dashboard Admin
        |-------------------------
        */
        Route::get('/dashboard',
            [AdminController::class, 'dashboard']
        )->name('dashboard');


        /*
        |-------------------------
        | Data Pengaduan
        |-------------------------
        */
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {

            Route::get('/', [AdminPengaduanController::class, 'index'])->name('index');

            Route::get('/{id}', [AdminPengaduanController::class, 'show'])->name('show');

            Route::get('/{id}/edit', [AdminPengaduanController::class, 'edit'])->name('edit');

            Route::put('/{id}/update', [AdminPengaduanController::class, 'update'])->name('update');

            Route::delete('/{id}/destroy', [AdminPengaduanController::class, 'destroy'])->name('destroy');
        });


        /*
        |-------------------------
        | Data Siswa
        |-------------------------
        */
        Route::get('/siswa', [AdminController::class, 'siswa'])->name('siswa.index');

        Route::get('/siswa/create', [AdminController::class, 'siswaCreate'])->name('siswa.create');

        Route::post('/siswa/store', [AdminController::class, 'siswaStore'])->name('siswa.store');

        Route::get('/siswa/edit/{id}', [AdminController::class, 'siswaEdit'])->name('siswa.edit');

        Route::put('/siswa/update/{id}', [AdminController::class, 'siswaUpdate'])->name('siswa.update');

        Route::delete('/siswa/delete/{id}', [AdminController::class, 'siswaDelete'])->name('siswa.delete');
    });
