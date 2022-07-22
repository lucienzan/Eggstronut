<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
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

   public function detail($id)
   {
    $article = Article::find($id);
    return view('blog.detail',compact('article'));
   }

   public function category($id)
   {
    $articles = Article::where(function($q){
      $q->when(request('keyword'),function($q){
        $keyword = request('keyword');
        $q->where("title","like","%$keyword%")
        ->orWhere("description","like","%$keyword%");
    });
})->where('category_id',$id)
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
