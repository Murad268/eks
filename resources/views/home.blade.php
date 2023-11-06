@extends('app')
@section('content')
<div class="blogs">
    @if($blogs->count() > 0)
    @foreach($blogs as $blog)
    <a class="blog">
        <div class="blog__img">
            <img src="{{asset('assets/images/'.$blog->image)}}" alt="">
        </div>
        <h3 class="blog_title">{{$blog->title}}</h3>
        <p>{{$blog->desc}}</p>
    </a>
    @endforeach
    @else
    <div>nothing</div>
    @endif
</div>
@endsection
