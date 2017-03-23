<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) 
        {
            $table->increments('id');        
            $table->integer('qtde_dec_dinheiro')->default(2);        
            $table->integer('qtde_dec_porcento')->default(2);        
            $table->string('skin',20)->default('blue');        
            $table->string('fix_navbar',1)->default('S');        
            $table->string('sidebar_collapse',1)->default('N');        
            $table->string('moeda',3)->default('R$');        
            $table->string('versao',20);        
            $table->timestamps();
            
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parametros');
    }
}
