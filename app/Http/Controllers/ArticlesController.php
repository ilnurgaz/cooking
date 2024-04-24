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

     return redirect()->back();
    }

    public function allData() {
        $articles = Articles::orderBy('created_at', 'desc')->take(10)->get();
        $count = Articles::orderBy('created_at', 'desc')->count();
        return view('articles', ['data' => $articles, 'count' => $count, 'page' => 0]);
    }

    public function allDataPagination($page) {
        $offset = $page * 10;
        $articles = Articles::orderBy('created_at', 'desc')->skip($offset)->take(10)->get();
        $count = Articles::all()->count();
        return view('articles', ['data' => $articles, 'count' => $count, 'page' => $page]);
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
   
        return redirect()->back();
       }

    public function deleteArticles($id) {
        Articles::find($id)->delete();
        return redirect()->back();



    }

    public function show($id)
    {
        $articles = Articles::find($id);
    
        $this->setTitle($articles->theme);
        $this->setDescription($articles->content);
    
        return view('articles.show', compact('articles'));
    }
    




}
