<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketLogController;
use App\Http\Controllers\TicketResponseController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
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
    Route::get('admin/detail_ticket/{id}',[TicketController::class, 'detail'])->name('detail_ticket.admin');
    Route::get('admin/{ticket_id}/form_response',[TicketResponseController::class, 'form_response'])->name('form_response.admin');
    Route::post('admin/{ticket_id}/response',[TicketResponseController::class,'create'])->name('create_response.admin');
    Route::get('admin/edit/ticket/{id}',[TicketController::class,'edit_form_ticket'])->name('edit_form_ticket.admin');
    Route::put('admin/update/ticket/{id}', [TicketLogController::class, 'ubah_status'])->name('ubah_status.admin');
    
    Route::get('admin/user',[UserController::class,'get'])->name('get_user');
    Route::get('admin/add_user',[UserController::class,'form_add'])->name('form_add_user');
    Route::get('admin/edit/{id}',[UserController::class,'edit'])->name('edit_user');
    Route::post('admin/add',[UserController::class,'add'])->name('add_user');
    Route::delete('admin/user/{id}',[UserController::class, 'delete'])->name('delete_user');
    route::put('admin/update/{id}',[UserController::class,'update'])->name('update_user');
});

Route::middleware('auth','permission:mahasiswa')->group(function(){
    Route::get('mahasiswa/ticket',[TicketController::class,'get'])->name('get_ticket.mahasiswa');
    Route::get('mahasiswa/form/ticket',[TicketController::class,'form_ticket'])->name('get_form_ticket.mahasiswa');
    Route::get('mahasiswa/detail/ticket/{id}',[TicketController::class,'detail'])->name('detail_ticket.mahasiswa');
    Route::post('mahasiswa/ticket',[TicketController::class,'add'])->name('add_ticket.mahasiswa');
    Route::delete('mahasiswa/ticket/{id}',[TicketController::class,'delete'])->name('delete_ticket.mahasiswa');
});

Route::middleware('auth', 'permission:staff')->group(function(){
    Route::get('staff/ticket',[TicketController::class, 'get'])->name('get_ticket.staff');
    Route::get('staff/detail_ticket/{id}',[TicketController::class, 'detail'])->name('detail_ticket.staff');
    Route::get('staff/{ticket_id}/form_response',[TicketResponseController::class, 'form_response'])->name('form_response.staff');
    Route::get('staff/edit/ticket/{id}',[TicketController::class,'edit_form_ticket'])->name('edit_form_ticket.staff');
    Route::post('staff/{ticket_id}/response',[TicketResponseController::class,'create'])->name('create_response.staff');
    Route::put('staff/update/ticket/{id}', [TicketLogController::class, 'ubah_status'])->name('ubah_status.staff');
});

require __DIR__.'/auth.php';
