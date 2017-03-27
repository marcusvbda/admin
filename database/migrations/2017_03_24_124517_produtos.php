<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) 
        {
            $table->increments('_id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant'); 

            $table->integer('codigo'); 
            $table->string('codigobarras',20)->nullable(); 
            $table->string('descricao',100); 
            $table->string('nome',100); //nomefantasia
            $table->string('unidade',6); 
            $table->string('unidadeentrada',6); 
            $table->string('tipoproduto',1); 
            $table->string('cst_entrada',6); //codigo_stentrada
            $table->string('cst_saida',6); //codigo_st
            $table->double('estoque',15,8); 
            $table->double('precovenda',15,8); 
            $table->double('custoatual',15,8); 
            $table->integer('grupoproduto_codigo');  //codigo_grupoproduto
            $table->integer('tipoproduto_codigo');  //codigo_tipoproduto
            $table->string('ncm',8); //codigo_nbmsh
            $table->string('anp',30); //codigoanp
            $table->string('cest',30); //CODIGO_CESTphp ar
            $table->date('ultimavenda')->nullable(); 


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
        Schema::drop('produtos');
    }
}
