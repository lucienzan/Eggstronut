@extends('layouts.app')

@section('title') Create Post @stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"><i class="feather-home"></i></a></li>
                          <li class="breadcrumb-item active" aria-current="page">Add Post</li>
                        </ol>
                      </nav>
                </div>
            </div>
        </div>
    </div>



@endsection