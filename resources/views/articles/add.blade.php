@extends('layouts.app');

@section('content')
    
    <div class="container" style="max-width: 800px">

        @if($errors):
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
        @endif

        <form method="post">
            @csrf

            <input type="text" class="form-control mb-2" name="title" placeholder="Title">
            <textarea name="body" class="form-control mb-2" placeholder="Body"></textarea>
            
            <select name="category_id" class="form-select mb-2">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>

@endsection
