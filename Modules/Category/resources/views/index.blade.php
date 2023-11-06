@extends('base::layouts.base-layout')

@section('content')
<div class="content">
    <a href="{{route('admin:categories.create')}}" class="btn btn-dark mb-2">create</a>
    @if($categories->count()>0)
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">slug</th>
                <th scope="col">controlls</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">1</th>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td style="display: flex; align-items: center;">
                    <form onsubmit="return confirm('are you sure?')" style="display: flex; align-items: center; column-gap: 5px" class="mt-2" method="post" action="{{route('admin:categories.destroy', $category->id)}}">
                        <a class="btn btn-success" href="{{route('admin:categories.edit', $category->slug)}}">edit</a>
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" value="delete" type="submit">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div>
        Nothing
    </div>
    @endif
</div>
@endsection
