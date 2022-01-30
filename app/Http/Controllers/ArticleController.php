<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Autor::where('id', $request->autor_id)->exists()) {
            Article::create($request->only('autor_id','title', 'content'));

             return response()->json([
                "message" => "Article  record created"
               ]);

           } else {
             return response()->json([
               "message" => "Autor not found"
             ]);
           }
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (Article::where('id', $id)->exists()) {
              $article= Article::find($id);
               return response()->json([$article]);
             } else {
             return response()->json([
               "message" => "Article not found"
             ]);
           }
    
    }

    public function getArticlesByAutorId($id){
        if (Autor::where('id', $id)->exists()) {
            $articles= Autor::with('article')->findOrFail($id);
            if (count($articles['article'])<1) {
                return response()->json([
                    "message" => "the Autor has no articles."
                  ]);
            } 
             return response()->json([$articles]);
           } else {
           return response()->json([
             "message" => "Autor not found"
           ]);
         }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Article::where('id', $id)->exists()) {
            $article= Article::find($id);
            $article->update($request->only('autor_id','title', 'content'));
            
             return response()->json([ "message" => "Article updated"]);
           } else {
           return response()->json([
             "message" => "Article not found"
           ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Article::where('id', $id)->exists()) {
        $article= Article::find($id);
        Comment::where('article_id',$article->id)->delete();
        $article->delete();
        return response()->json([
            "message" => "Article deleted"
          ]);
    }else{
        return response()->json([
            "message" => "Article not found"
          ]);
    }
}
    
}
