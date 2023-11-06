@extends('base::layouts.base-layout')

@section('content')
<div class="content">
    <form method="post" action="{{route('admin:categories.update', $category->slug)}}">
        @csrf
        @method('put')
        @foreach(LaravelLocalization::getSupportedLanguagesKeys() as $lang)
        <div class="form-group mb-3">
            <label for="exampleInputPassword1">Kategoriyanın adı {{$lang}} dilində</label>
            <input name="name[{{ $lang }}]" value="{{ old('name.' . $lang, $category->getTranslation('name', $lang)) }}" type="text" class="form-control" placeholder="Kategoriyanı adını daxil edin">
        </div>
        @endforeach
        <button class="btn btn-primary">update category</button>
    </form>
</div>
@endsection
