<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FethiController;
use App\Http\Controllers\SecretaireContoller;

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


route::middleware('Secretaire')->group(function(){
Route::get('/fethi', [FethiController::class, 'index'])->name('fethi');
}) ;


Route::resource('Patients', 'App\Http\Controllers\PatientsController');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/secretaire/login',[SecretaireContoller::class, 'login'])->name('secretaire-login') ;
Route::post('/secretaire/login' ,[SecretaireContoller::class, 'authenticate'])->name('secretaire-authenticate') ;


require __DIR__.'/auth.php';
