<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $all = Article::all();
        // foreach($all as $a){
        //     $a->excerpt = Str::words($a->description,50);
        //     $a->update();
        // }
        $articles = Article::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->where("title","like","%$keyword%")
            ->orWhere("description","like","%$keyword%");
        })
        ->latest('id')
        ->with(['user','category'])
        ->paginate(10)->withQueryString();
        
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description,50);
        $article->slug = Str::slug($article->title)."-".uniqid();
        $article->category_id = $request->category;
        $article->user_id = Auth::id();
        $article->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        if($article->title != $request->title){
        $article->slug = Str::slug($article->title)."-".uniqid();
        }
        $article->title = $request->title;
        $article->description = $request->description;
        $article->excerpt = Str::words($request->description,50);
        $article->category_id  = $request->category;
        $article->user_id = Auth::id();
        $article->update();
        return to_route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route("article.index",["page"=>request()->page]);
    }
}
