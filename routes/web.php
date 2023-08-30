<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KasirController;

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
    return view('login');
});
Route::get('/l',[AuthController::class,'logout'])->name('logout');
Route::post('/verivication-users', [AuthController::class, 'login_u'])->name('login');

Route::group(['middleware' => ['auth:manager']], function() {
  Route::get('/manager', [ManagerController::class, 'index']);
  //menu
  Route::get('/manager/menu', [ManagerController::class, 'show_menu'])->name('manager.menu');
  Route::get('/manager/menu/create', [ManagerController::class, 'create_menu']);
  Route::post('/manager/menu/c', [ManagerController::class, 'p_c_menu'])->name('p000menu');
    Route::get('/manager/menu/edit/{id}', [ManagerController::class, 'edit_menu']);
  Route::put('/manager/menu/e', [ManagerController::class, 'p_e_menu'])->name('p001menu');
  Route::get('/manager/menu/delete/{id}', [ManagerController::class, 'D_menu']);
});

Route::group(['middleware' => ['auth:web']], function() {
  Route::get('/kasir', [KasirController::class, 'index']);
});
