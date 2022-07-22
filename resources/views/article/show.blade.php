@extends('layouts.app')

@section('head')

@endsection
@section('title')Create Articles @stop

@section('content')
<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('article.index') }}">Articles</a></li> 
    <li class="breadcrumb-item active" aria-current="page">Articles Detail</li> 
</x-bread-crumb>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $article->title }}</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>
                            <i class="feather-user"></i>
                            {{ $article->user->name }}
                        </span>
                        <span>
                            <i class="feather-layers"></i>
                            {{ $article->category->title }}
                        </span>
                        <span>
                            <i class="feather-calendar"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <p class="text-black-50 h5">{{ $article->description }}</p>
                </div>
            </div>
        </div>
    </div>
    
@endsection