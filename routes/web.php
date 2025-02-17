<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user(); // Simpan user agar tidak dipanggil berulang

    // Daftar role yang valid
    $validRoles = ['admin', 'staff', 'mahasiswa'];
    // Cek apakah role user valid
    if (in_array($user->role, $validRoles)) {
        return view($user->role . '/dashboard');
    }

    // Jika role tidak valid, tampilkan error
    abort(403, 'Role tidak dikenali');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','permission:admin')->group(function () {
    Route::get('admin/category',[CategoryController::class,'get'])->name('get_category');
    Route::post('admin/category',[CategoryController::class,'add'])->name('add_category');
    Route::put('admin/category/{id}',[CategoryController::class,'update'])->name('update_category');
    Route::delete('admin/category{id}',[CategoryController::class,'delete'])->name('delete_category');

    Route::get('admin/ticket',[TicketController::class,'get'])->name('get_ticket.admin');
});

Route::middleware('auth','permission:mahasiswa')->group(function(){
    Route::get('mahasiswa/ticket',[TicketController::class,'get'])->name('get_ticket.mahasiswa');
    Route::get('mahasiswa/form/ticket',[TicketController::class,'form_ticket'])->name('get_form_ticket.mahasiswa');
    Route::get('mahasiswa/detail/ticket/{id}',[TicketController::class,'detail'])->name('detail_ticket.mahasiswa');
    Route::post('mahasiswa/ticket',[TicketController::class,'add'])->name('add_ticket.mahasiswa');
    Route::delete('mahasiswa/ticket/{id}',[TicketController::class,'delete'])->name('delete_ticket.mahasiswa');
});

require __DIR__.'/auth.php';
