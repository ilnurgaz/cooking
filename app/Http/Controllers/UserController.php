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
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles]);
    }

    public function recipesPagination($page) {
        $offset = $page * 20;
        $count_recipes = Recipes::count();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $recipes = Recipes::orderBy('created_at', 'desc')->offset($offset)->take(20)->get();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'articles' => $articles]);
    }

    
}
