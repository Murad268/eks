@extends('base::layouts.base-layout')

@section('content')
<div class="content">
    <form enctype="multipart/form-data" method="post" action="{{route('admin:blogs.store')}}">
        @csrf
        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun şəkli</label>
            <input type="file" name="image" id="">
        </div>
        @error('image')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun banneri</label>
            <input type="file" name="banner" id="">
        </div>
        @error('banner')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun adı {{$lang}} dilində</label>
            <input name="title[{{ $lang }}]" value="{{ old('title.' . $lang) }}" type="text" class="form-control" placeholder="Bloqun adını daxil edin">
            @error("title.{$lang}")
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun açıqlaması {{$lang}} dilində</label>
            <textarea placeholder="Bloqun açıqlamasını daxil edin" name="desc[{{ $lang }}]" value="{{ old('desc.' . $lang) }}" class="form-control"></textarea>
            @error("desc.{$lang}")
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endforeach

        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Bloqun kateqoriyası</label>
            <select class="form-select" name="category_id">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->getTranslation('name', app()->getLocale())}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary">add category</button>
    </form>

</div>
@endsection
