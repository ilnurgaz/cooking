<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest;
use App\Models\Articles;

class ArticlesController extends Controller
{
    public function submit(Request $req) {
     $articles = new Articles();
     $articles->theme = $req->input('theme');
     $articles->content = $req->input('content');

     $image = $req->file('image');
     if($image) {
         $imageName = $image->getClientOriginalName(); 
         $articles->image = $imageName; 
         $tmpPath = $image->getPathname();
         $path = public_path('./assets/image/articles');
     }
     else {
         $articles->image = 'image-placeholder.png'; 
     }

     if($image) {
        move_uploaded_file($tmpPath, $path . '/' . $imageName);
        }

     $articles->save();

     return redirect()->route('admin-articles');
    }

    public function allData() {
        return view('articles', ['data' => Articles::all()]);
    }

    public function showOneMessage($id){
        $articles = new Articles;
        return view('one-articles', ['data' => $articles->find($id)]);
    }

    public function updateArticles($id) {
        $articles = new Articles;
        return view('update-articles', ['data' => $articles->find($id)]);
    }

    public function updateArticlesSubmit($id, Request $req) {
        $articles = Articles::find($id);
        $articles->theme = $req->input('theme');
        $articles->content = $req->input('content');
   
        $image = $req->file('image');
        if($image) {
            $imageName = $image->getClientOriginalName(); 
            $articles->image = $imageName; 
            $tmpPath = $image->getPathname();
            $path = public_path('./assets/image/articles');
        }
        else {
            $articles->image = 'image-placeholder.png'; 
        }
   
        if($image) {
           move_uploaded_file($tmpPath, $path . '/' . $imageName);
           }
   
        $articles->save();
   
        return redirect()->route('articles-data');
       }

    public function deleteArticles($id) {
        Articles::find($id)->delete();
        return redirect()->route('articles-data');



    }
}
