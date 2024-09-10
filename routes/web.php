<?php

use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CobrosController;
use App\Http\Controllers\CuotasController;
use App\Http\Controllers\PrestamosController;
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




Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

//Route::post('/logIn', [LogInController::class, 'store'])->name('logIn');

Route::get('/registro', [RegisterController::class, 'create'])->name('formRegister');
Route::post('/registro', [RegisterController::class, 'store'])->name('userCreate');

Route::post('/logOut', [LogOutController::class, 'destroy'])->middleware('auth')->name('logOut');

Route::post('/logIn', [LogInController::class, 'store'])->name('logIn');

Route::resource('/clientes', ClienteController::class,);
Route::get('/reporte/resumen', [ReporteController::class, 'resumen'])->name('resumen');
Route::get('reporte/cliente', [ReporteController::class, 'cliente'])->name('reporte.cliente');
Route::get('/reporte/entre_fechas', [ReporteController::class, 'entre_fechas'])->name('entre_fechas');
Route::get('/reporte/cliente/{id}/pdf', [ReporteController::class, 'descargarPdf'])->name('cliente.pdf');

//Route::get('/clientes/{id}/amortizacion', [ClienteController::class, 'mostrarAmortizacion'])->name('clientes.amortizacion');

//Route::resource('/cobros', CobrosController::class);

//Route::resource('/cuotas', CuotasController::class);

Route::resource('/prestamos', PrestamosController::class);

// Ruta para realizar pagos de cuotas
//Route::post('/prestamos/cuotas/{cuota}/pagar', [PrestamosController::class, 'pagarCuota'])->name('prestamos.pagarCuota');


Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth')->name('home');
