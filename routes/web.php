<?php

use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PointageController;


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

//Route::get('/principal', function () {return view('principal');});

//https://walkerspider.com/cours/laravel/middlewares/





Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/admin/register', [AdministrateurController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AdministrateurController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdministrateurController::class, 'dashboard'])->name('administrateurs.dashboard');
    Route::get('/admin/informations_personnelles', [AdministrateurController::class, 'informationsPersonnelles'])->name('administrateurs.informations_personnelles');
    Route::resource('/personnel', PersonnelController::class);
    Route::get('/personnel/{id}/generateQrCode', [PersonnelController::class, 'generateQrCode'])->name('personnel.generateQrCode');
    Route::get('/personnel/details/{id}', [PersonnelController::class, 'show'])->name('personnel.details');
    Route::get('/dashboard', [PersonnelController::class, 'dashboard'])->name('dashboard');
    Route::resource('/paiement', PaiementController::class);
    Route::get('/paiement/{id}/generatePDF', [PaiementController::class, 'generatePDF'])->name('paiement.generatePDF');
    Route::resource('/pointage', PointageController::class);
    Route::resource('administrateurs',AdministrateurController::class);
});

Route::get('/administrateurs/create', [AdministrateurController::class, 'create'])->name('administrateurs.create');
Route::post('/administrateurs', [AdministrateurController::class, 'store'])->name('administrateurs.store');

Route::get('/principal', function () {return view('administrateurs.principal');})->name('administrateurs.principal');
Route::get('/afficher', [PointageController::class, 'affiche'])->name('pointage.affiche');


Route::get('/pointage/create', [PointageController::class, 'create'])->name('pointage.create');
Route::post('/pointage', [PointageController::class, 'store'])->name('pointage.store');
