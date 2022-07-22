@extends('layouts.app')

@section('title') Profile @stop

@section('head')
    <style>
        .profile{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .button{
            height: 38px;
        }
    </style>
@endsection
@section('content')

<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li> 
</x-bread-crumb>

    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-3">
                        {{-- {{ $user->name }} --}}
                        @if ($user->profile == "")
                            <img src="{{ asset('default-user-image.png') }}" alt="" class="profile">
                            @elseif (session('photoNull'))
                            <img src="{{ asset(session('photoNull')) }}" alt="" class="profile">
                            @else
                            <img src="{{ asset('storage/profile/'.$user->profile) }}" alt="" class="profile">
                        @endif
                    </div>
                    <form action="{{ route('user.update',$user->id) }}" method="post" class="d-flex" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                            <input type="file" class="form-control @error('profile')
                            is-invalid
                        @enderror" name="profile">
                        @error('profile')
                        <div class="invalid-feedback">
                             {{ $message }}
                         </div> 
                         @enderror
                        </div>
                     <button class="ms-2 btn btn-primary button" >Upload</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 ">
            <div class="card mt-3 mt-lg-0">
                <div class="card-body">
                    <form action="{{ route('user.updateName') }}" method="post">
                        @csrf
                        <div class="">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name')
                        is-invalid
                        @enderror" value="{{ old('name',$user->name)  }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <button class="mt-2 btn btn-primary button">Update</button>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{ route('user.updateEmail',$user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email')
                        is-invalid
                        @enderror" value="{{ old('email',$user->email)  }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <button class="mt-2 btn btn-primary button">Update</button>
                    </form>
                </div>
        </div>
    </div>



@endsection