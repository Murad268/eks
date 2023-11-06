@extends('base::layouts.base-layout')

@section('content')
<div class="content">
    <a href="{{route('admin:blogs.create')}}" class="btn btn-dark mb-2">create</a>
    @if($blogs->count() > 0)
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">slug</th>
                <th scope="col">image</th>
                <th scope="col">banner</th>
                <th scope="col">kateqoriyası</th>

                <th scope="col">controlls</th>
            </tr>
        </thead>
        <tbody>

            @foreach($blogs as $blog)
            <tr>
                <td>{{$blog->id}}</td>

                <td>{{$blog->title}}</td>
                <td>{{$blog->slug}}</td>
                <td>
                    <img style="width: 200px; height: 80px" src="{{asset('assets/images/'.$blog->image)}}" alt="">
                </td>
                <td>
                    <img style="width: 200px; height: 80px" src="{{asset('assets/images/'.$blog->banner)}}" alt="">
                </td>
                <td>
                    @if ($blog->category)
                    {{ $blog->category->getTranslation('name', app()->getLocale()) }}
                    @else
                    No Category
                    @endif
                </td>
                <td>
                    <form onsubmit="return confirm('are you sure?')" style="display: flex; align-items: center; column-gap: 5px" class="mt-2" method="post" action="{{route('admin:blogs.destroy', $blog->id)}}">
                        <a class="btn btn-success" href="{{route('admin:blogs.edit', $blog->slug)}}">edit</a>
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
        nothing
    </div>
    @endif
</div>
@endsection
