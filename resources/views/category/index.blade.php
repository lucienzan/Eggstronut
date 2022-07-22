@extends('layouts.app')

@section('head')
    <style>
        tbody tr{
            vertical-align: middle;
        }
    </style>
@endsection
@section('title') Add Category @stop

@section('content')
<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Category Lists</li> 
</x-bread-crumb>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control @error('title')
                                is-invalid
                            @enderror">
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title">Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug')
                                is-invalid
                            @enderror">
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        @include('category.categoryList')
    </div>
    
@endsection