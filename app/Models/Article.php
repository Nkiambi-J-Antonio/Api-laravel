<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
      protected $fillable=[ 'autor_id','title', 'content' ];

      public function commments(){
        return $this->hasMany(Comment::class) ;  
      }
}
