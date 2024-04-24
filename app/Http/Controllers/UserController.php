<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\Recipes;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function recipes() {
        $count_recipes = Recipes::count();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $recipes = Recipes::orderBy('created_at', 'desc')->take(20)->get();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles, 'cat_pag' => false]);
    }

    public function recipesPagination($page) {
        $offset = $page * 20;
        $count_recipes = Recipes::count();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $recipes = Recipes::orderBy('created_at', 'desc')->offset($offset)->take(20)->get();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'articles' => $articles, 'cat_pag' => false]);
    }

    public function recipesCategory($category) {
        $category_id = categories::where('name', $category)->get();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $recipes = Recipes::where('category', $category_id[0]->id)->take(20)->get();
        $count_recipes = Recipes::where('category', $category_id[0]->id)->count();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles, 'cat_active' => $category_id[0]->name, 'cat_pag' => false]);
    }

    public function recipesCategoryPagination($category, $page) {
        $offset = $page * 20;
        $category_id = categories::where('name', $category)->get();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $recipes = Recipes::where('category', $category_id[0]->id)->take(20)->offset($offset)->get();
        $count_recipes = Recipes::where('category', $category_id[0]->id)->count();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'articles' => $articles, 'cat_active' => $category_id[0]->name, 'cat_pag' => true]);
    }
    
}
