<?php

namespace App\Http\Controllers;
use App\Models\categories;
use App\Models\Recipes;
use Illuminate\Http\Request;
use App\Http\Requests\AdminReguest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\RecipesReguest;

class AdminController extends Controller
{

    // Categories

    public function addCateory(categoryRequest $req) {

        $category = new categories();
        $category->name = $req->input('name');
        $category->description = $req->input('description');
        $category->slug = $req->input('slug');
        
        $image = $req->file('image');
        if($image) {
            $imageName = $image->getClientOriginalName(); 
            $category->image = $imageName; 
            $tmpPath = $image->getPathname();
            $path = public_path('./assets/image/categorises');
        }
        else {
            $category->image = 'image-placeholder.png'; 
        }
        

        try {
            if($image) {
            move_uploaded_file($tmpPath, $path . '/' . $imageName);
            }

            $category->save();
            
            Session::flash('success', 'Категория успешно создана.');

            return redirect()->back();
        } catch (\Exception $e) {
            if ($category->exists) {
                $category->delete();
            }

            Session::flash('error', 'Ошибка добавления.');

            return redirect()->back();
        }
    }

    public function allCategories() {
        $categories = categories::orderBy('created_at', 'desc')->take(10)->get();
        $count = categories::count();
        return view('admin-cat', ['data' => $categories, 'count' => $count, 'page' => 0]);
    }

    public function allCategoriesPagination($page) {
        $offset = $page * 10;
        $count = categories::count();
        $categories = categories::orderBy('created_at', 'desc')->skip($offset)->take(10)->get();
        return view('admin-cat', ['data' => $categories, 'count' => $count, 'page' => $page]);
    }

    public function deleteCategory($id) {
        // Находим категорию по ID
        $category = categories::find($id);
    
        // Если категория найдена
        if ($category) {
            // Находим все рецепты с этой категорией
            $recipes = Recipes::where('category', $category->id)->get();
    
            // Удаляем найденные рецепты
            foreach ($recipes as $recipe) {
                $recipe->delete();
            }
    
            // Удаляем саму категорию
            $category->delete();
    
            return redirect()->back()->with('success', 'Категория и связанные с ней рецепты были удалены.');
        } else {
            // Если категория не найдена
            return redirect()->back()->with('error', 'Категория не найдена.');
        }
    }

    public function updateCategory($id) {
        $category = new categories();
        return view('admin-cat-update', ['data' => $category->find($id)]);
    }

    public function updateCategoryController(categoryRequest $reg, $id) {
        $category = categories::find($id);
        $category->name = $reg->input('name');
        $category->description = $reg->input('description');
        $category->slug = $reg->input('slug');
        $image = $reg->file('image');
        if($image) {
            $imageName = $image->getClientOriginalName(); 
            $category->image = $imageName; 
            $tmpPath = $image->getPathname();
            $path = public_path('./assets/image/categorises');
        }
        try {
            if($image) {
                move_uploaded_file($tmpPath, $path . '/' . $imageName);
                }
                $category->save();
                Session::flash('success', 'Категория успешно обновлена.');
                return redirect()->back();
        }
        catch(\Exception $e) {
            Session::flash('error', 'Ошибка обновления.');
            return redirect()->back();
        }
    }

    // Recipes

    public function allRecipes() {
        $recipes = Recipes::orderBy('created_at', 'desc')->take(10)->get();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $count = Recipes::count();
        return view('admin-recipes', ['data' => $recipes, 'count' => $count, 'page' => 0, 'categories' => $categories, 'cat_pag' => false]);
    }

    public function allRecipesPagination($page) {
        $offset = $page * 10;
        $count = Recipes::count();
        $categories = categories::orderBy('created_at', 'desc')->get();
        $recipes = Recipes::orderBy('created_at', 'desc')->skip($offset)->take(10)->get();
        return view('admin-recipes', ['data' => $recipes, 'count' => $count, 'page' => $page, 'categories' => $categories,'cat_pag' => false]);
    }

    public function allRecipesFilter(Request $reg) {
        $categoryId = $reg->input('category');
        $categoryArr = categories::where('id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = $categoryArr[0]->name;
        return redirect()->route('recipes-cat', ['category' => $category]);
    }

    public function allRecipesCat(Request $reg, $category) {
        $category = categories::where('name', $category)->orderBy('created_at', 'desc')->get();
        $categoryId = $category[0]->id;
        $categories = categories::orderBy('created_at', 'desc')->get();
        $count = Recipes::where('category', $categoryId)->count();
        $recipes = Recipes::where('category', $categoryId)->orderBy('created_at', 'desc')->take(10)->get();
        return view('admin-recipes', ['data' => $recipes, 'count' => $count, 'page' => 0, 'categories' => $categories, 'cat_pag' => true, 'categoryName' => $category[0]->name]);
    }

    public function allRecipesCatPagination($category, $page) {
        $offset = $page * 10;
        $category = categories::where('name', $category)->orderBy('created_at', 'desc')->get();
        $categoryId = $category[0]->id;
        $categories = categories::orderBy('created_at', 'desc')->get();
        $count = Recipes::where('category', $categoryId)->count();
        $recipes = Recipes::where('category', $categoryId)->orderBy('created_at', 'desc')->skip($offset)->take(10)->get();
        return view('admin-recipes', ['data' => $recipes, 'count' => $count, 'page' => $page, 'categories' => $categories, 'cat_pag' => true, 'categoryName' => $category[0]->name]);
    }

    public function addRecipes(RecipesReguest $reg) {
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

    public function deleteRecipes($id) {
        Recipes::find($id)->delete();
        return redirect()->back()->with('success', 'Рецепт был удален.');
    }

    public function updateRecipes($id) {
        $recipes = new Recipes();
        $categories = categories::orderBy('created_at', 'desc')->get();
        return view('admin-recipes-update', ['data' => $recipes->find($id), 'categories' => $categories]);
    }

    public function updateRecipesController(RecipesReguest $reg, $id) {
        $recipes = Recipes::find($id);
        $recipes->name = $reg->input('name');
        $recipes->description = $reg->input('description');
        $recipes->video = $reg->input('video');
        $recipes->time_cook = $reg->input('time_cook');
        $recipes->number_servings = $reg->input('number_servings');
        $recipes-> ingredients  = $reg->input('ingredients');
        $recipes->recipes = $reg->input('recipes');
        $recipes->category = $reg->input('category');
        $image = $reg->file('image');
        if($image) {
            $imageName = $image->getClientOriginalName(); 
            $recipes->image = $imageName; 
            $tmpPath = $image->getPathname();
            $path = public_path('./assets/image/recipes');
        }
        try {
            if($image) {
                move_uploaded_file($tmpPath, $path . '/' . $imageName);
                }
                $recipes->save();
                Session::flash('success', 'Рецепт успешно обновлен.');
                return redirect()->back();
        }
        catch(\Exception $e) {
            Session::flash('error', 'Ошибка обновления.');
            return redirect()->back();
        }
    }

}
