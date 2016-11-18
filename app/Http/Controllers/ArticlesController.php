<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

class ArticlesController extends Controller
{
    //
    public function index(){
        $articles = Article::latest('id')->paginate(5);
        return view('home',compact('articles'));
    }

    public function show($id){
        $article = Article::find($id);
        return view('articles.show' , compact('article'));
    }
}
