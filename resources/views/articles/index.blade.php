@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 800px">
        {{ $articles->links() }}

        @if(session('info'))
        <div class="alert alert-danger">
                {{session("info")}}
        </div>
        @endif

        @if(session('create'))
        <div class="alert alert-success">
                {{session("create")}}
        </div>
        @endif

        @if(session('edit'))
        <div class="alert alert-success">
                {{session("edit")}}
        </div>
        @endif

        @foreach($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h3 class="h4">
                        {{ $article->title }}
                    </h3>
                    <div class="text-muted">
                        <b class="text-danger">{{ $article->user->name }}</b>|
                        Category: <b class="text-primary">{{ $article->category->name }}</b>
                        <div class="ml-3">{{ $article->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="mb-2">
                        {{$article->body}}
                    </div>
                    <div>
                        <a href="{{ url("/articles/detail/$article->id") }}" 
                            class="text-secondary text-decoration-none">Comments: 
                            <b>{{count($article->comments)}}</b>
                        </a>
                    </div>
                    <a href="{{ url("/articles/detail/$article->id") }}">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection