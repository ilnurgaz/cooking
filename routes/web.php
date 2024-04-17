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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::post('/contact/submit', 'App\Http\Controllers\ContactController@submit')-> name ('contact-form');






Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin');
        } elseif (auth()->user()->hasRole('user')) {
            return redirect()->route('main');
        } 
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['role:admin']], function () { 
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    Route::get(
        '/admin-cat',
        'App\Http\Controllers\AdminController@allCategories'
    )->name('admin-categories');

    Route::get(
        '/admin-cat/{page}',
        'App\Http\Controllers\AdminController@allCategoriesPagination'
    )->name('admin-categories-pagination');
    
    Route::post(
        '/admin/add-cat',
        'App\Http\Controllers\AdminController@addCateory'
    )->name('add-category');

    Route::get(
        '/admin-cat/{id}/delete',
        'App\Http\Controllers\AdminController@deleteCategory'
    )->name('cat-delete');

    Route::get(
        '/admin/{id}/cat-update',
        'App\Http\Controllers\AdminController@updateCategory'
    )->name('cat-update');

    Route::post(
        '/admin/{id}/cat-update-controller',
        'App\Http\Controllers\AdminController@updateCategoryController'
    )->name('cat-update-controller');

    Route::get(
        '/admin-recipes',
        'App\Http\Controllers\AdminController@allRecipes'
    )->name('admin-recipes');

    Route::get(
        '/admin-recipes/{page}',
        'App\Http\Controllers\AdminController@allRecipesPagination'
    )->name('admin-recipes-pagination');

    Route::post(
        '/admin/add-recipes',
        'App\Http\Controllers\AdminController@addRecipes'
    )->name('admin-add-recipes');

    Route::get(
        '/admin-recipes/{id}/delete',
        'App\Http\Controllers\AdminController@deleteRecipes'
    )->name('recipes-delete');

    Route::get(
        '/admin-recipes/{id}/update',
        'App\Http\Controllers\AdminController@updateRecipes'
    )->name('recipes-update');

    Route::post(
        '/admin/{id}/recipes-update-controller',
        'App\Http\Controllers\AdminController@updateRecipesController'
    )->name('recipes-update-controller');

    Route::post(
        '/admin-recipes/fil',
        'App\Http\Controllers\AdminController@allRecipesFilter'
    )->name('recipes-cat-fil');

    Route::get(
        '/admin-recipes/cat/{category}',
        'App\Http\Controllers\AdminController@allRecipesCat'
    )->name('recipes-cat');
    Route::get(
        '/admin-recipes/cat/{category}/{page}',
        'App\Http\Controllers\AdminController@allRecipesCatPagination'
    )->name('recipes-cat-pagination');

    Route::get(
        '/contact/all', 
        'App\Http\Controllers\ContactController@allData'
    )-> name ('contact-data');

    Route::get('/admin-articles', function () {
        return view('admin-articles');
    })->name('admin-articles');

    Route::post(
        '/admin-articles/submit', 
        'App\Http\Controllers\ArticlesController@submit'
    )->name('articles-form');;


});

Route::get('/css/{file}', function ($file) {
    $css = File::get(resource_path("css/{$file}"));
    return response($css)->header('Content-Type', 'text/css');
});

require __DIR__.'/auth.php';

