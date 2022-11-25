<?php

use Illuminate\Support\Facades\Route;

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



//Route::get('Patients/search', ['App\Http\Controllers\PatientsController@search']);

Route::controller('App\Http\Controllers\PatientsController')->group(function () {
    Route::post('Patients/search', 'search')->name('Patients.search') ;
});


Route::resource('Patients', 'App\Http\Controllers\PatientsController');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';
