<?php

namespace App\Http\Controllers;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function addCateory(AdminRequest $req) {

        $category = new categories();
        $category->name = $req->input('name');
        $category->description = $req->input('description');
        $category->slug = $req->input('slug');
        $image = $req->file('image');
        $imageName = $image->getClientOriginalName(); 
        $category->image = $imageName; 
        $tmpPath = $image->getPathname();
        $path = public_path('./assets/image/categorises');

        try {
            move_uploaded_file($tmpPath, $path . '/' . $imageName);

            $category->save();
            
            Session::flash('success', 'Категория успешно создана.');

            return redirect()->route('admin-categories')->withErrors(['error' => 'К сожалению, произошла ошибка.']);
        } catch (\Exception $e) {
            if ($category->exists) {
                $category->delete();
            }

            Session::flash('error', 'Ошибка добавления.');

            return redirect()->route('admin-categories');
        }
    }

    public function allCategories() {
        $category = new categories();
        return view('admin-cat', ['data' => $category->orderBy('created_at', 'desc')->take(5)->get()]);
    }

    public function deleteCategory($id) {
        categories::find($id)->delete();
        return redirect()->route('admin-categories')->with('success', 'Категория была удалена.');
    }
    
}
