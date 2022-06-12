<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Cambiar @return \Illuminate\Http\Response por 
    // @return Renderable

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $articles = Article::with(relations: 'category')->latest()->paginate();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $article = new Article;
        $title = __('Crear artículo');
        $action = route('articles.store');
        return view('articles.form', compact('article','title','action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
