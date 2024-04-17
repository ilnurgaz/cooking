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
     $articles->image = $req->input('image');
     $articles->content = $req->input('content');

     $articles->save();

     return redirect()->route('admin-articles');
    }
}
