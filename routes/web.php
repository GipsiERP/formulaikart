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

Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/', function () {
    // return view('welcome');
    return redirect('welcome');
});

Auth::routes([
    'register' => false, // registrar no login
    //'login' => false,  // Desativar tela login
    'verify' => false,
    'reset' => true // permite reset senha (link)
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getResultEvent', [App\Http\Controllers\HomeController::class, 'getResultEvent'])->name('getResultEvent');
Route::get('/getResultEventReproc/{id}', [App\Http\Controllers\HomeController::class, 'getResultEventReproc'])->name('getResultEventReproc');

Route::get('/geraCategoriaDrivers', [App\Http\Controllers\HomeController::class, 'geraCategoriaDrivers'])->name('geraCategoriaDrivers');
Route::get('/openEvent/{event_id}', [App\Http\Controllers\HomeController::class, 'openEvent'])->name('openEvent');
Route::get('/kartRaffle', [App\Http\Controllers\HomeController::class, 'kartRaffle'])->name('kartRaffle');
Route::post('/kartRaffle', [App\Http\Controllers\HomeController::class, 'kartRaffle'])->name('kartRaffle');
Route::get('/ReportskartRaffle', [App\Http\Controllers\ReportsController::class, 'kartRaffle'])->name('/ReportskartRaffle');
Route::post('/ReportskartRaffle', [App\Http\Controllers\ReportsController::class, 'kartRaffle'])->name('/ReportskartRaffle');

Route::resource('/TeamDrivers', App\Http\Controllers\TeamDriversController::class);
Route::resource('/Drivers', App\Http\Controllers\DriversController::class);
Route::resource('/Events', App\Http\Controllers\EventsController::class);
Route::resource('/Tracks', App\Http\Controllers\TracksController::class);
Route::resource('/Championships', App\Http\Controllers\ChampionshipsController::class);
Route::resource('/Banks', App\Http\Controllers\BanksController::class);
Route::resource('/Finances', App\Http\Controllers\FinancesController::class);


Route::get('/clear-cache', function() {
    Artisan::call('storage:link');
    //Artisan::call('migrate:refresh');
    // Artisan::call('migrate');
    Artisan::call('db:seed');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    // Artisan::call('view:clear');
    // Artisan::call('clear-compiled');
    // Artisan::call('auth:clear-resets');
    // Artisan::call('event:clear');
    // Artisan::call('optimize:clear');

    return "Cache is cleared";
});
