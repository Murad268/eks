@extends('base::layouts.base-layout')
@section('content')
<div class="content">
    <form enctype="multipart/form-data" method="post" action="{{ route('admin:blogs.update', ['blog' => $blog->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="image">Bloqun şəkli</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <img style="width: 200px; height: 80px" src="{{asset('assets/images/'.$blog->image)}}" alt="">
        </div>
        <div class="form-group mb-3">
            <label for="banner">Bloqun banneri</label>
            <input type="file" name="banner" id="banner">
        </div>
        <div>
            <img style="width: 200px; height: 80px" src="{{asset('assets/images/'.$blog->banner)}}" alt="">
        </div>
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <div class="form-group mb-3">
            <label for="title">Bloqun adı {{ $lang }} dilində</label>
            <input name="title[{{ $lang }}]" value="{{ old('title'.$lang, $blog->getTranslation('title', $lang)) }}" type="text" class="form-control" placeholder="Bloqun adını daxil edin">
            @error("title.{$lang}")
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <div class="form-group mb-3">
            <label for="desc">Bloqun açıqlaması {{ $lang }} dilində</label>
            <textarea name="desc[{{ $lang }}]" class="form-control">{{ old('desc'.$lang, $blog->getTranslation('desc', $lang)) }}</textarea>
            @error("desc.{$lang}")
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun kateqoriyası</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                <option {{old('category_id', $category->id == $blog->category_id? 'selected': "")}} value="{{$category->id}}">{{$category->getTranslation('name', app()->getLocale())}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary">Bloqu yenilə</button>
    </form>
</div>
@endsection
