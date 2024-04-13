<?php

namespace App\Http\Controllers;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\categoryRequest;

class AdminController extends Controller
{

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

            return redirect()->route('admin-categories');
        } catch (\Exception $e) {
            if ($category->exists) {
                $category->delete();
            }

            Session::flash('error', 'Ошибка добавления.');

            return redirect()->route('admin-categories');
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
        categories::find($id)->delete();
        return redirect()->route('admin-categories')->with('success', 'Категория была удалена.');
    }

    public function updateCategory($id) {
        $category = new categories();
        return view('admin-cat-update', ['data' => $category->find($id)]);
    }

    public function updateCategoryController(categoryRequest $req, $id) {
        $category = categories::find($id);
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
        try {
            if($image) {
                move_uploaded_file($tmpPath, $path . '/' . $imageName);
                }
                $category->save();
                Session::flash('success', 'Категория успешно обновлена.');
                return redirect()->route('cat-update', $id);
        }
        catch(\Exception $e) {
            Session::flash('error', 'Ошибка обновления.');
            return redirect()->route('cat-update', $id);
        }
    }
    
}
