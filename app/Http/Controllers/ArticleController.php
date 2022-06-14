<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRecuest;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Redirect;

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
     * @param  ArticleRequest  $request
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $validated = $request->safe()->only(['title','content', 'category_id']);
        Article::create($validated);

        session()->flash('success', __('El articulo ha sido creado correctamente'));
        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return Renderable
     */
    public function show(Article $article): Renderable
    {
        // Carga las relaciones con load 
        $article->load('user:id,name', 'category:id,name');
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return Renderable
     */
    public function edit(Article $article): Renderable
    {
        $title = __('Actualizar artículo');
        $action = route('articles.update', ['article' => $article]);
        return view('articles.form', compact('article', 'title', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->safe()->only(['title','content', 'category_id']);
        $article->update($validated);

        session()->flash('success', __('El articulo ha sido actualizado correctamente'));
        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        session()->flash('success', __('El articulo ha sido elimando correctamente'));
        return redirect(route('articles.index'));
    }
}
