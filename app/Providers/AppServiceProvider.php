<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        View::share('categories', Category::latest('id')->with(['user'])->paginate(5));
        View::share('categoriesAll', Category::latest('id')->with(['user'])->get());
        View::share('articlesAll', Article::latest('id')->with(['user','category'])->get());

    }
}
