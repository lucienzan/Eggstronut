
@extends('layouts.app')

@section('head')
    <style>
        tbody tr{
            vertical-align: middle;
        }
    </style>
@endsection
@section('title') Articles @stop

@section('content')
<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Articles</li> 
</x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Category</th>
                                <th>Owner</th>
                                <th>Control</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $key => $article)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <span class="text-bold h5">{{ Str::words($article->title,5) }}</span>
                                        <br>
                                        <p class="text-black-50 mb-0">{{ Str::words($article->description,10) }}</p>
                                    </td>
                                    <td>{{ $article->category->title }}</td>
                                    <td>{{ $article->user->name }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('article.edit',$article->id) }}" class="btn btn-outline-warning">
                                            <i class="feather-edit-2"></i>
                                        </a>
                                        <a href="{{ route('article.show',$article->id) }}" class="btn btn-outline-info">
                                            <i class="feather-align-justify"></i>
                                        </a>
                                        <form action="{{ route('article.destroy',[$article->id,"page"=>request()->page]) }}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger">
                                                <i class="feather-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <span>{{ $article->created_at->format('d M Y') }}</span>
                                            <br>
                                        <span>{{ $article->created_at->format('h : i A') }}</span>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6">There is no data at this point.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
    
@endsection