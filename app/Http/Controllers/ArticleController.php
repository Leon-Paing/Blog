<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(['index', 'detail']);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view('articles.detail', [
            'article' => $article
        ]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('articles.add', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = Auth::id();
        $article->save();

        return redirect('/articles')->with("create", "Created New Article!");
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $user_id = Auth::id();

        if ($user_id == $article->user_id) {
            $categories = Category::all();
            return view('articles.edit', [
                'categories' => $categories,
                'article' => $article,
            ]);
        }

        return back()->with("unedit", "Unauthorized action!");
    }

    public function edited($id)
    {
        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = Auth::id();
        $article->save();

        return redirect('/articles')->with("edit", "Edited an article!");
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows('delete-article', $article)) {
            $article->delete();
            return redirect("/articles")->with("info", "Deleted an article!");
        }

        return back()->with("info", "Unauthorized action");
    }
}