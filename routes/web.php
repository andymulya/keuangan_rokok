<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', \App\Livewire\Profile\ProfilePage::class)->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', \App\Livewire\User\UserTable::class)->can('user index')->name('user.index');

    Route::get('/roles', \App\Livewire\Role\RoleTable::class)->can('role index')->name('role.index');

    Route::get('/operators', \App\Livewire\Operator\OperatorTable::class)->can('operator index')->name('operator.index');

    Route::get('/schedule', \App\Livewire\Schedule\ScheduleTable::class)->can('schedule index')->name('schedule.index');

    Route::get('/shift', \App\Livewire\Shift\ShiftTable::class)->can('shift index')->name('shift.index');

    Route::get('/rekap-material', \App\Livewire\RekapMaterial\RekapMaterialTable::class)->can('rekap-material index')->name('rekap-material.index');

    Route::get('/data-pembelian', \App\Livewire\DataPembelian\DataPembelianTable::class)->can('data-pembelian index')->name('data-pembelian.index');
});

require __DIR__ . '/auth.php';
