<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::prefix('project')->group(function () {
        Route::get('/index', [ProjectController::class, 'index'])->name('admin.project.index');
        Route::get('/projects-data', [ProjectController::class, 'paginatedProjects'])->name('admin.project.projects.data');
        Route::post('/store', [ProjectController::class, 'store'])->name('admin.project.projects.store');
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/categories-project', [CategoryController::class, 'projectsByCategory'])->name('admin.categories.projects');
        Route::get('/categories-projects-data', [CategoryController::class, 'projectsByCategoryId'])->name('admin.categories.projects.byid');
    });
});

require __DIR__.'/auth.php';
