<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); 
           
            /*
            fiz uma generalização total e exclusiva neste caso entre a tabela users e a tabela autors
             quer dizer um autor é um usuario.
            */

             /*
              $table->foreignId('user_id')->constrained(); 
               Essa é a boa forma de definir relacionamento entre as tabelas em lararal 8
                em laravel 7 seria assim:
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
             */
            
          
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autors');
    }
}
