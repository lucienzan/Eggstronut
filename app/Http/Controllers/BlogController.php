<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
   public function index()
   {

    $articles = Article::when(request('keyword'),function($q){
        $keyword = request('keyword');
        $q->where("title","like","%$keyword%")
        ->orWhere("description","like","%$keyword%");
    })
    ->latest('id')
    ->with(['user','category'])
    ->paginate(10)->withQueryString();
    return view('welcome',compact('articles'));
   }

   public function detail($slug)
   {
    $article = Article::where("slug",$slug)->first();
    return view('blog.detail',compact('article'));
   }

   public function category($slug)
   {
    $category_id = Category::where('slug',$slug)->first()->id;
    $articles = Article::where(function($q){
      $q->when(request('keyword'),function($q){
        $keyword = request('keyword');
        $q->where("title","like","%$keyword%")
        ->orWhere("description","like","%$keyword%");
    });
})->where('category_id',$category_id)
    ->latest('id')
    ->with(['user','category'])
    ->paginate(10)->withQueryString();    
    return view('welcome',compact('articles'));
   }

   public function name($name)
   {
        $user = User::where("name",$name)->first()->id;
        $articles = Article::where('user_id',$user)
        ->latest('id')
        ->with(['user','category'])
        ->paginate(10)->withQueryString();
        
        return view('welcome',compact('articles'));
   }

    public function date($date)
    {

    function generateTime($date){
       return date('Y-m-d',strtotime($date));
    };

    $articles = Article::whereDate('created_at',generateTime($date))
    ->latest('id')
    ->with(['user','category'])
    ->paginate(10)->withQueryString();
    return view('welcome',compact('articles'));
    
    }


}
