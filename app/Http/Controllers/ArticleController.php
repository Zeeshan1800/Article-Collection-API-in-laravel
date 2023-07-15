<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $articles = Article::orderBy('id')->get();
        return response()->json($articles);
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:30',
            'content' => 'required',
            'author' => 'required',
            'category' => 'required',
            'published_at' => 'required|date'
        ]);

        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if ($article) {
            return response()->json($article);
        } else {
            return response()->json(['error' => 'the response code is 200'], 200);
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:30',
            'content' => 'required',
            'author' => 'required',
            'category' => 'required',
            'published_at' => 'required|date'
        ]);

        $article = Article::find($id);

        if ($article) {
            $article->update($request->all());
            return response()->json($article);
        } else {
            return response()->json(['error' => 'Article not found'], 404);
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if ($article) {
            $article->delete();
            return response()->json(['message' => 'Article deleted']);
        } else {
            return response()->json(['error' => 'The response code is 404'], 404);
        }
    }
}
