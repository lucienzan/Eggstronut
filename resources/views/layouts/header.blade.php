@php
    use Illuminate\Support\Facades\Auth;
@endphp
@section('title') Dashboard @stop
@section('head')
    <style>
        .profile{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
@endsection
    
<div class="row header mb-4">
    <div class="col-12">
        <div class="p-2 bg-primary rounded d-flex justify-content-between align-item-center">
            <button class="show-btn btn btn-primary btn-link d-block d-lg-none">
                <i class="feather-menu text-light"></i>
            </button>
            @if (request()->path() == "dashboard/category")
            <form action="{{ route('category.index') }}" method="get" class="d-none d-lg-inline" style="margin-block: auto;">
                <div class="form d-flex">
                    <input type="text" class="form-control" value="{{ old('keyword',request('keyword')) }}" name="keyword"  id="">
                    <button class="btn btn-light btn-search">
                        <i class="feather-search"></i>
                    </button>
                </div>
            </form>
            @elseif (request()->path() == "dashboard/article")
            <form action="{{ route('article.index') }}" method="get" class="d-none d-lg-inline" style="margin-block: auto;">
                <div class="form d-flex">
                    <input type="text" class="form-control" name="keyword" value="{{ old('keyword',request('keyword')) }}"  id="">
                    <button class="btn btn-light btn-search">
                        <i class="feather-search"></i>
                    </button>
                </div>
            </form>
            @elseif (request()->path() == "dashboard/profile/user-manage")
            <form action="{{ route('user.manage') }}" method="get" class="d-none d-lg-inline" style="margin-block: auto;">
                <div class="form d-flex">
                    <input type="text" class="form-control" name="keyword" value="{{ old('keyword',request('keyword')) }}"  id="">
                    <button class="btn btn-light btn-search">
                        <i class="feather-search"></i>
                    </button>
                </div>
            </form>
            @endif
            <div class="dropdown dropbox">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::user()->profile == null )
                        <img src="{{ asset('default-user-image.png') }}" alt="" class="user-img">
                        {{ Auth::user()->name ?? "Gust" }}
                        @elseif (session('photNull'))
                        <img src="{{ asset(session('photoNull')) }}" alt="" class="user-img">
                        {{ Auth::user()->name ?? "Gust" }}
                        @else
                        <img src="{{ asset('storage/profile/'.Auth::user()->profile) }}" alt="" class="user-img">
                        {{ Auth::user()->name ?? "Gust" }}
                    @endif
                    </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                  <li><a class="dropdown-item active" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>    
                </li>
                </ul>
              </div>
        </div>
    </div>
</div>
@section('foot')
<script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
<script>
    let currentPage = location.href
   console.log(currentPage)
   $(".nav-item-link").each(function() {
       let links = $(this).attr("href");
       if (links == currentPage) {
           $(this).addClass("active");
       }
   })
   $(".show-btn").click(function(){
    $(".aside").animate({marginLeft:0});
});
$(".close-btn").click(function(){
    $(".aside").animate({marginLeft:"-100%"})
});
</script>
@endsection