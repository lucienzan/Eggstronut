@php
    use Illuminate\Support\Facades\Auth;
    use App\Base;
@endphp
<div class="col-12 col-lg-3 col-xl-2 vh-100 aside">
    <div class=" py-3 mt-3 d-flex justify-content-between align-items-center brand-logo">
        <div class="d-flex justify-content-between align-items-center">
            <img src="{{ asset(Base::$photo) }}" alt="" width="40px">
            <span style="margin-left: 5px;">
                <p class="mb-0 h4 text-uppercase">{{ Base::$name }}</p>
            </span>
        </div>
        <button class="close-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-secondary"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>
            {{-- <li class="nav-item">
               <a href="{{ route('home') }}" class="nav-item-link">
                   <span>
                    <i class="feather-home"></i>
                    Dashboard
                   </span>
               </a>
            </li> --}}
            <x-menu-item link="{{ route('home') }}" class="feather-home" name="Dashboard" ></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            {{-- <li class="nav-item">
                <a href="{{ route('dashboard.create') }}" class="nav-item-link">
                    <span>
                        <i class="feather-plus-circle"></i>
                        Add Item
                    </span>
                </a>
                <a href="items-list.html" class="nav-item-link ">
                    <span>
                        <i class="feather-list"></i>
                        Item list
                    </span>
                    <Span class="badge badge-pill bg-light shadow-sm text-black-50">12</Span>
                </a>
            </li> --}}
            <x-menu-title title="Category Manager"></x-menu-title>
            <x-menu-item link="{{ route('category.index') }}" class="feather-layers" counter="{{ $categoriesAll->count() }}" name="Category Lists" ></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="Post Manager"></x-menu-title>
            <x-menu-item link="{{ route('article.create') }}" class="feather-file-plus" name="Add Article" ></x-menu-item>
            <x-menu-item link="{{ route('article.index') }}" class="feather-file-text" counter="{{ $articlesAll->count() }}" name="Articles" ></x-menu-item>
            <x-menu-spacer></x-menu-spacer>

            <x-menu-title title="Personal Information"></x-menu-title>
            <x-menu-item link="{{ route('user.show',Auth::id()) }}" class="feather-user" name="Profile" ></x-menu-item>
            <x-menu-item link="{{ route('user.changePassword' ) }}" class="feather-lock" name="Update Password"></x-menu-item>
            {{-- <li class="nav-item">
                <a class="nav-item-link">
                    <span>
                        <i class="feather-plus-circle"></i>
                        Add Item
                    </span>
                    <Span class="badge badge-pill bg-light shadow-sm text-black-50">12</Span>
                </a>
                <a class="nav-item-link">
                    <span>
                        <i class="feather-list"></i>
                        Item Link
                    </span>
                    <Span class="badge badge-pill bg-light shadow-sm text-black-50">12</Span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>

@section('foot')
<script>
     let currentPage = location.href
    console.log(currentPage)
    $(".nav-item-link").each(function() {
        let links = $(this).attr("href");
        if (links == currentPage) {
            $(this).addClass("active");
        }
    })

</script>
@endsection