<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LineaTiempoController;
use Illuminate\Support\Facades\Route;
use App\Models\LineaTiempo;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return view('welcome', [
        'LineaTiempo' => LineaTiempo::select('id', 'ano', 'titulo', 'descripcion', 'imagen')->get(),
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/GestionUsuarios', [ProfileController::class, 'main'])->name('GestionUsuarios');
    Route::get('/lista-usuarios', [ProfileController::class, 'ListaUsuarios'])->name('ListaUsuarios')->middleware('auth');
    Route::get('/EditarUsuarios/{id}', [ProfileController::class, 'EditarUsuarios'])->name('EditarUsuarios')->middleware('auth');
    Route::POST('/actualizar/{id}', [ProfileController::class, 'actualizar'])->name('actualizar')->middleware('auth');
    Route::get('/CrearUsuarioVista', [ProfileController::class, 'CrearUsuarioVista'])->name('CrearUsuarioVista')->middleware('auth');
    Route::POST('/CrearUsuario', [ProfileController::class, 'Crear'])->name('CrearUsuario')->middleware('auth');
    Route::get('/LineaTiempo', [LineaTiempoController::class, 'index'])->name('LineaTiempo')->middleware('auth');
    Route::get('/lista-LineaTiempo', [LineaTiempoController::class, 'ListaLineaTiempo'])->name('lista-LineaTiempo')->middleware('auth');
    Route::get('/CrearLineaTiempo', [LineaTiempoController::class, 'crear'])->name('CrearLineaTiempo')->middleware('auth');
    Route::POST('/storeLineaTiempo', [LineaTiempoController::class, 'store'])->name('storeLineaTiempo')->middleware('auth');
    Route::get('/EditarLineaTiempo/{id}', [LineaTiempoController::class, 'update'])->name('EditarLineaTiempo')->middleware('auth');
    Route::POST('/actualizarLineaTiempo/{id}', [LineaTiempoController::class, 'actualizar'])->name('actualizarLineaTiempo')->middleware('auth');
    Route::get('/EliminarLineaTiempo/{id}', [LineaTiempoController::class, 'destroy'])->name('EliminarLineaTiempo')->middleware('auth');

    Route::get('/GestionDocumentos', [DocumentoController::class, 'index'])->name('GestionDocumentos')->middleware('auth');
    Route::get('/ListaDocumentos', [DocumentoController::class, 'ListaDocumentos'])->name('ListaDocumentos')->middleware('auth');

    Route::match(['get', 'post'], '/CrearDocumento', [DocumentoController::class, 'crear'])
        ->name('CrearDocumento')
        ->middleware('auth');

    Route::POST('/storeDocumentos', [DocumentoController::class, 'store'])->name('storeDocumentos')->middleware('auth');

});


Route::get('/PersonalizaAvion', function () {
    return view('juegos.avionManera');
})->name('PersonalizaAvion');

Route::get('/simuladorAvion', function () {
    return view('juegos.simuladorAvion');
})->name('simuladorAvion');

require __DIR__ . '/auth.php';
