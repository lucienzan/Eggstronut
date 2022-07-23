@extends('layouts.app')
@section('title')
    User Management
@endsection

@section('head')
    <style>
        tbody tr{
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
<x-bread-crumb>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Lists</li> 
</x-bread-crumb>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Controller</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $roleName = array('Admin','User');
                        @endphp
                            @foreach ($users as $key=>$user )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $roleName[$user->role] }}</td>
                                    <td>
                                        @if ($user->role != 0)

                                        <form action="{{ route('user-manage.role') }}" id="form{{ $user->id }}" method="post" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" value="{{ $user->id }}" name="id">
                                            <button type="button" class="btn btn-outline-primary" onclick="return showConfirm({{ $user->id }})">
                                                Admin
                                            </button>
                                        </form>
                                        
                                        @if ($user->isBanned == "0")
                                        <form action="{{ route('user-manage.ban-role') }}" id="banForm{{ $user->id }}" method="post" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" value="{{ $user->id }}" name="id">
                                            <button type="button" class="btn btn-outline-danger" onclick="return banConfirm({{ $user->id }})">
                                                Ban
                                            </button>
                                        </form>

                                        @elseif ($user->isBanned == "1")  

                                        <form action="{{ route('user-manage.ban-role') }}" id="unbanForm{{ $user->id }}" method="post" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" value="{{ $user->id }}" name="id">
                                            <button type="button" class="btn btn-outline-danger" onclick="return unbanConfirm({{ $user->id }})">
                                                Unban
                                            </button>
                                        </form>
                                        @endif

                                        <button class="btn btn-outline-secondary" onclick="changePw({{ $user->id }},'{{ $user->name }}')">Change Password</button>

                                        @elseif ($user->role === "0")

                                        <form action="{{ route('user-manage.role') }}" id="form{{ $user->id }}" method="post" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" value="{{ $user->id }}" name="id">
                                            <button type="button" class="btn btn-outline-primary" onclick="return showConfirm({{ $user->id  }})">
                                                User
                                            </button>
                                        </form>

                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('d M Y') }}
                                        <br>
                                        {{ $user->created_at->format('h : i a') }}
                                    </td>
                                    <td>
                                        {{ $user->updated_at->format('d M Y') }}
                                        <br>
                                        {{ $user->updated_at->format('h : i a') }}
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $users->onEachSide(1)->links() }}

            </div>
        </div>
    </div>
</div>
{{-- @php
$name = $user->name;
@endphp
let name = <?php echo json_encode($name) ?>; --}}

@endsection
<script src="{{ asset('js/blog.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showConfirm(id){
    showConfirmRole(id);       
    }
    function banConfirm(id){
    banConfirmRole(id);       
    }
    function unbanConfirm(id){
    unbanConfirmRole(id);
    }
    function changePw(id,name){
    let url = "{{ route('user-manage.change-password') }}";
    Swal.fire({
        title: "Do you want to change password for "+name+" ?",
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off',
          required: "required",
          minLength: 8,
        },
        showCancelButton: true,
        confirmButtonText: 'Change',
        showLoaderOnConfirm: true,
        preConfirm: function (newPassword){
            $.post(url,{
                id : id,
                newPassword : newPassword,
                _token: "{{ csrf_token() }}" ,
            }).done(function(data){
                if(data.status == 200){
                    Swal.fire({
                        icon : "success",
                        title : "Password changed!",
                        text: data.message,
                    });
                }else{
                    Swal.fire({
                        icon : "error",
                        text: data.message.password[0],
                    });
                }
            })
        }
      })
    }
</script>