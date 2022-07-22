@php
   use App\Models\Article;
@endphp
@extends('blog.master')
@section('title') EGGstronut | Detail @stop

@section('content')

<div class="">

   <div class="small post-category mb-3">
      <a href="{{ route('baseOnCategory',$article->category->id) }}" rel="category tag">{{ $article->category->title }}</a>
  </div>
  <h2 class="fw-bolder">{{ $article->title }} </h2>
  <div class="my-3 feature-image-box">
   {{-- <img width="1024" height="682" src="assets/images/de0d23dd-86f6-3ee1-a871-6325fb45bd06-1024x682.jpg"> --}}
   <div class="d-block d-md-flex justify-content-between align-items-center my-3">
      <div class="">
         @if ($article->user->profile == null)
         <img alt="" class="profile" src="{{ asset('default-user-image.png') }}">
         @else
         <img alt="" class="profile" src="{{ asset('storage/profile/'.$article->user->profile) }}">
         @endif
            <a href="{{ route('baseOnName',$article->user->name) }}" class="text-decoration-none" title="Visit admin’s website" rel="author external">{{ $article->user->name }}</a>
      </div>
      @php
         // $create_time = strtotime($x);
         function createdTime($x){
            return strtotime($x);
         }
      @endphp
   <a class="text-primary text-decoration-none" href="{{ route('baseOnDate',$article->created_at->format('Ymd'))}}">
       <i class="fas fa-calendar"></i>
       {{ $article->created_at->format('d M Y h : i a') }}
   </a>
</div>

<div class="text-black-50">
   <p>{{ $article->description }}</p>
</div>


@php

   $previousBtn = Article::where('id',"<",$article->id)->latest('id')->first();
   $nextBtn = Article::where('id',">",$article->id)->first();

@endphp
{{ date('d-m-Y',strtotime('1658392200')) }}

<div class="nav d-flex justify-content-between p-3">
   <a href="{{ route('detail',$previousBtn->id ?? "200") }}"
      class="btn btn-outline-primary page-mover rounded-circle">
       <i class="fas fa-chevron-left"></i>
   </a>

   <a class="btn btn-outline-primary px-3 rounded-pill" href="{{ route('index') }}">
       Read All
   </a>

   <a href="{{ route('detail',$nextBtn->id ?? "1") }}"
      class="btn btn-outline-primary page-mover rounded-circle">
       <i class="fas fa-chevron-right"></i>
   </a>
</div>
</div>
</div>
@endsection