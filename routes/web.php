<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PerfilController;



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




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    
    Route::get('perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('perfil', [PerfilController::class, 'store'])->name('perfil.store');
    Route::get('perfil/edit/{id}', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('perfil/{id}', [PerfilController::class, 'update'])->name('perfil.update');
    Route::delete('perfil/{id}', [PerfilController::class, 'destroy'])->name('perfil.destroy');

});




Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
        return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::get('/productosusuario', function () {
        return view('productos');
});

Route::get('/productoinfo', function () {
    return view('Productoinfo');
})->name('productoinfo');


require __DIR__.'/auth.php';
