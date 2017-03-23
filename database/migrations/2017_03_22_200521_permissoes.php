<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('descricao',150);
            $table->string('nome',150);
            $table->integer('modulo_id')->unsigned(); 
            $table->foreign('modulo_id')
                ->references('id')
                    ->on('modulos');   

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
        Schema::drop('permissoes');
    }
}
