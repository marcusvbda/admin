<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dadosfaturamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dadosfaturamento', function (Blueprint $table) 
        {
            $table->increments('_id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('codigo');
            $table->integer('produto_codigo');
            $table->double('valorproduto',15,8); 
            $table->date('datanegociacao')->nullable(); 
            $table->time('hora')->nullable(); 
            $table->double('quantidade',15,8); 
            $table->double('valorunitario',15,8); 
            $table->string('motorista',20);            
            $table->string('placa',10);   
            $table->integer('numeronota');
            $table->date('emissao');
            $table->integer('caixa_codigo');
            $table->string('excluido',1);    
            $table->string('nomecliente',20);   
            $table->date('datacancelamento');
            $table->double('valordesconto',15,8); 
            $table->double('valoracrescimo',15,8); 
            $table->double('valortotalcupom',15,8); 

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
        Schema::drop('dadosfaturamento');
    }
}
