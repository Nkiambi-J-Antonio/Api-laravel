<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;



use Hash;

class AutorController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if (!$request->password) {
              $request['password']=Hash::make('1234');
          } else{
             $request['password']=Hash::make($request->password);
          }
          $user=User::create($request->only('name','email','password'));
          Autor::create(['user_id'=>$user->id]);
          
          return response()->json([
             "message" => "Autor record created"
           ]
          );
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Autor::where('id', $id)->exists()) {
           $autor=User::find($id);
            return response()->json( $autor);
          } else {
            return response()->json([
              "message" => "Autor not found"
            ]);
          }
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
        if (Autor::where('id', $id)->exists()) {
            $user=User::find($id);
            $user->name= $request->name;
            $user->email= $request->email;
          if ($request->password) {
               $user->password= Hash::make($request->password);
             }
             $user->save();
              
             return response()->json(['message'=>'Autor  '.$user->name.'  updated successfully']);
           } else {
             return response()->json([
               "message" => "Autor not found"
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
        if (Autor::where('id', $id)->exists()) {
          $autor= Autor::find($id);
          $articles=Article::where('autor_id', $autor->id)->get();

           foreach($articles as $article){
               if (Comment::where('article_id', $article->id)->exists()) {
                  Comment::where('article_id',$article->id)->delete();
               }
           
           }
           Article::where('autor_id', $id)->delete();
        
        $autor->delete();
        return response()->json([
            "message" => "Autor deleted"
          ]);
    }else{
        return response()->json([
            "message" => "Article not found"
          ]);
    }
    }
}
