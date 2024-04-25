<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\Recipes;
use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RecipesReguest;

class UserController extends Controller
{
    public function recipes(Request $req) {
        $searchTerm = $req->input('search');
        if($searchTerm) {
            $count_recipes = Recipes::where('name', 'like', '%' . $searchTerm . '%')->count();
            $categories = categories::orderBy('created_at', 'asc')->get();
            $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
            $recipes = Recipes::where('name', 'like', '%' . $searchTerm . '%')->get();
            $count_recipes = Recipes::where('name', 'like', '%' . $searchTerm . '%')->count();
            if($count_recipes > 0) {
                $count = 1;
            }
            else {
                $count = 0;
            }
            return view('recipes', ['categories' => $categories, 'count' => $count, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles, 'cat_pag' => false, 'cat_active' => false]);
        }
        else {
            $count_recipes = Recipes::count();
            $categories = categories::orderBy('created_at', 'asc')->get();
            $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
            $recipes = Recipes::orderBy('created_at', 'desc')->take(20)->get();
            return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles, 'cat_pag' => false, 'cat_active' => false]);
        }
    }

    public function recipesPagination($page) {
        $offset = $page * 20;
        $count_recipes = Recipes::count();
        $articles = Articles::orderBy('created_at', 'asc')->take(4)->get();
        $categories = categories::orderBy('created_at', 'asc')->get();
        $recipes = Recipes::orderBy('created_at', 'desc')->offset($offset)->take(20)->get();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'articles' => $articles, 'cat_pag' => false, 'cat_active' => false]);
    }

    public function recipesCategory($category) {
        $category_id = categories::where('slug', $category)->get();
        $categories = categories::orderBy('created_at', 'asc')->get();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $recipes = Recipes::where('category', $category_id[0]->id)->take(20)->get();
        $count_recipes = Recipes::where('category', $category_id[0]->id)->count();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'articles' => $articles, 'cat_active' => $category_id[0]->slug, 'cat_name' => $category_id[0]->name, 'cat_description' => $category_id[0]->description, 'cat_pag' => false]);
    }

    public function recipesCategoryPagination($category, $page) {
        $offset = $page * 20;
        $category_id = categories::where('slug', $category)->get();
        $categories = categories::orderBy('created_at', 'asc')->get();
        $articles = Articles::orderBy('created_at', 'desc')->take(4)->get();
        $recipes = Recipes::where('category', $category_id[0]->id)->take(20)->offset($offset)->get();
        $count_recipes = Recipes::where('category', $category_id[0]->id)->count();
        return view('recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'articles' => $articles, 'cat_active' => $category_id[0]->slug, 'cat_name' => $category_id[0]->name, 'cat_description' => $category_id[0]->description, 'cat_pag' => true]);
    }

    public function recipePage($id) {
        $recipe = Recipes::find($id);
        $category = categories::where('id', $recipe->category)->get();
        return view('recipe-page', ['data' => $recipe, 'category' => $category[0]->name, 'cat_slug' => $category[0]->slug]);
    }

    public function addRecipes() {
        $categories = categories::orderBy('created_at', 'asc')->get();
        return view('add-recipes', ['categories' => $categories]);
    }

    public function addRecipesController(RecipesReguest $reg) {
        $recipes = new Recipes();
        $recipes->id_user = Auth::user()->id;
        $recipes->name = $reg->input('name');
        $image = $reg->file('image');
        if($image) {
            $imageName = $image->getClientOriginalName(); 
            $recipes->image = $imageName; 
            $tmpPath = $image->getPathname();
            $path = public_path('./assets/image/recipes');
        }
        else {
            $recipes->image = 'image-placeholder.png'; 
        }
        $recipes->description = $reg->input('description');
        $recipes->video = $reg->input('video');
        $recipes->time_cook = $reg->input('time_cook');
        $recipes->number_servings = $reg->input('number_servings');
        $recipes-> ingredients  = $reg->input('ingredients');
        $recipes->recipes = $reg->input('recipes');
        $recipes->category = $reg->input('category');
        $recipes->publish = 1;

        try {
            $recipes->save();

            if($image) {
                move_uploaded_file($tmpPath, $path . '/' . $imageName);
            }
            
            Session::flash('success', 'Рецепт успешно создан.');

            return redirect()->back();
        } catch (\Exception $e) {
            if ($recipes->exists) {
                $recipes->delete();
            }

            Session::flash('error', 'Ошибка добавления.');

            return redirect()->back();
        }
    }

    public function myRecipes() {
        $user_id = Auth::user()->id;
        $count_recipes = Recipes::where('id_user', $user_id)->count();
        $recipes = Recipes::where('id_user', $user_id)->take(20)->get();
        $categories = categories::orderBy('created_at', 'asc')->get();
        return view('my-recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => 0, 'cat_pag' => false, 'cat_active' => false]);
    }

    public function myRecipesPagination($page) {
        $offset = 20 * $page;
        $user_id = Auth::user()->id;
        $count_recipes = Recipes::where('id_user', $user_id)->count();
        $recipes = Recipes::where('id_user', $user_id)->offset($offset)->take(20)->get();
        $categories = categories::orderBy('created_at', 'asc')->get();
        return view('my-recipes', ['categories' => $categories, 'count' => $count_recipes, 'recipes' => $recipes, 'page' => $page, 'cat_pag' => false, 'cat_active' => false]);
    }
    
}
