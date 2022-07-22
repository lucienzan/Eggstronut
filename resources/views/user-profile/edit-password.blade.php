@extends('layouts.app')

@section('title') Change Password @stop

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li> 
    </x-bread-crumb>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.updatePassword') }}" method="post">
                        @csrf
                        <div class="mb-3">
                        <label for="">Current Password</label>
                        <input type="password" name="current_password" autocomplete="current-password" class="form-control @error('current_password')
                            is-invalid
                        @enderror"> 
                        @error('current_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="new_password" autocomplete="current-password" class="form-control @error('new_password')
                                is-invalid
                            @enderror"> 
                            @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">New Password</label>
                                <input type="password" name="new_confirm_password" autocomplete="current-password" class="form-control @error('new_confirm_password')
                                    is-invalid
                                @enderror"> 
                                @error('new_confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                                @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection