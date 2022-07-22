@extends('layouts.app')

@section('head')

@endsection
@section('title')Create Articles @stop

@section('content')
<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Articles</li> 
</x-bread-crumb>
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="mb-0">Create Article</h3>
                    <form action="{{ route('article.store') }}" id="articlepost" method="post">
                    @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="category">All Category {{ old('category') }}</label>
                        <select name="category" form="articlepost" id="category" class="form-select form-select-lg @error('category')
                            is-invalid
                        @enderror">
                            <option value="" disabled selected>Select the category</option>
                            @foreach ( $categoriesAll as $key => $category  )
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? "selected" : "" }}  >{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title">Article Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" form="articlepost" id="title" class="form-control @error('title')
                            is-invalid
                        @enderror">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="description">Article Description</label>
                        <textarea type="text" rows="15" name="description" form="articlepost" id="description" class="form-control @error('description')
                            is-invalid
                        @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary w-100" form="articlepost">Create</button>
                </div>
            </div>
        </div>

    </div>
    
@endsection