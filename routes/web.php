<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Projectscontroller;
use App\Http\Controllers\Admin\Typescontroller;
use App\Http\Controllers\Admin\Tecnologiescontroller;

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

Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Qui sono inserite tutte le rotte protette da auth
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('projects', Projectscontroller::class);
        Route::resource('tecnologies', Tecnologiescontroller::class);
        Route::resource('types', Typescontroller::class);
        //Rotte custom
        //Rotta per ordinare in base al nome del progetto
        Route::get('orderby/{direction}/{column}', [Projectscontroller::class, 'orderby'])->name('orderby');
    });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
