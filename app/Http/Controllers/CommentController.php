<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
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
        if (Article::where('id', $request->article_id)->exists()) {
               Comment::create($request->only('article_id', 'grade','comment'));

               return response()->json([
                "message" => "Comment record  created"
              ]);
        }else {
             return response()->json([
                "message" => "Article not found"
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
         if (Comment::where('id', $id)->exists()) {
              $comment=  Comment::find($id);
               return response()->json([$comment]);
             } else {
             return response()->json([
               "message" => "Comment not found"
             ]);
           }
    }
    

    public function getCommentsByArticleId($id){
         
        if (Article::where('id', $id)->exists()) {
            $comments= Article::with('commments')->findOrFail($id);
            if (count($comments['commments'])<1) {
                
                return response()->json([
                    "message" => "thearticle has no comments."
                  ]);
            } 
             return response()->json([$comments]);
           } else {
           return response()->json([
             "message" => "Article not found"
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
        if (Comment::where('id', $id)->exists()) {
            $comment= Comment::find($id);
            $comment->update($request->only('article_id', 'grade','comment'));
            
             return response()->json([ "message" => "Comment updated"]);
           } else {
           return response()->json([
             "message" => "Comment not found"
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
        if (Comment::where('id', $id)->exists()) {
            $comment= Comment::find($id);
            $comment->delete();
            return response()->json([
                "message" => "Comment deleted"
              ]);
        }else{
            return response()->json([
                "message" => "Comment not found"
              ]);
        }
    }
}
