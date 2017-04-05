<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Manutencaocaixa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manutencaocaixa', function (Blueprint $table) 
        {
            $table->increments('_id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('codigo');
            $table->string('tipo',1);   
            $table->string('documento',20);   
            $table->date('data');
            $table->time('hora');
            $table->integer('funcionario_codigo');
            $table->string('descricao',50);    
            $table->string('classificacao',2);    
            $table->double('valor',15,8); 

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
        Schema::drop('manutencaocaixa');
    }
}
