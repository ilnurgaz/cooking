<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;



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
    return view('main');
})->name('main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['role:admin']], function () { 
    Route::get('/admin', function () {
        return view('admin');
    });

    Route::get(
        '/admin-cat',
        'App\Http\Controllers\AdminController@allCategories'
    )->name('admin-categories');
    
    Route::post(
        '/admin/add-cat',
        'App\Http\Controllers\AdminController@addCateory'
    )->name('add-category');

    Route::get(
        '/admin-cat//{id}/delete',
        'App\Http\Controllers\AdminController@deleteCategory'
    )->name('cat-delete');

    Route::get(
        '/admin/{id}/cat-update',
        'App\Http\Controllers\AdminController@updateCategory'
    )->name('cat-update');
});

Route::get('/css/{file}', function ($file) {
    $css = File::get(resource_path("css/{$file}"));
    return response($css)->header('Content-Type', 'text/css');
});

require __DIR__.'/auth.php';
