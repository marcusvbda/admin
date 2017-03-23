<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('codigo');
            $table->string('contato',30);
            $table->string('email',250);
            $table->string('telefone',20);
            $table->string('celular',20);
            $table->integer('pessoa_id')->unsigned();   
            
            $table->foreign('pessoa_id')
            ->references('id')
                ->on('pessoas');
                    
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
        Schema::drop('contatos');
    }
}
