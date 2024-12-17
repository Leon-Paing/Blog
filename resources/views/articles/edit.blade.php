@extends('layouts.app');

@section('content')
    
    <div class="container" style="max-width: 800px">

        <form method="post">
            @csrf
            <input type="text" class="form-control mb-2" name="title" placeholder="Title" value="{{$article->title}}"></input>
            <textarea name="body" class="form-control mb-2" placeholder="Body">{{ $article->body }}
            </textarea>
            <select name="category_id" class="form-select mb-2">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" 
                        @selected($article->category_id == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection
