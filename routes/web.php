<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;


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
/*
Route::get('/', function () {
    return view('/','/login');
});
*/
Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    Route::get('/recetas/search', [App\Http\Controllers\RecetaController::class, 'search'])->name('recetas.search');

    Route::resource('recetas', RecetaController::class);

    Route::get('/recetas/{receta}/pdf', [RecetaController::class, 'generarPdf'])->name('recetas.pdf');
    Route::get('/recetas/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
    Route::get('/recetas/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
    Route::put('/recetas/{receta}', [RecetaController::class, 'update'])->name('recetas.update');               
});

require __DIR__.'/auth.php';
