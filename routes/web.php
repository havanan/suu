<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\AuthController as ManagerAuthController;
use App\Http\Controllers\Manager\DashBoardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

//Route::view('/{any}', 'home')->where('any', '.*');
Route::prefix('manager')->group(function (){
    Route::get('login', [ManagerAuthController::class,'login']);
    Route::post('login', [ManagerAuthController::class,'postLogin'])->name('manager.login');
    Route::group([
        'middleware' => 'auth'
    ],function (){
        Route::get('dashboard', [DashBoardController::class,'index'])->name('dashboard.index');
    });
});
