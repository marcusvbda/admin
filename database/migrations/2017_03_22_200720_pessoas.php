<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) 
        {
            $table->increments('id');           
            $table->string('razao',150)->nullable();
            $table->string('nome',150);
            $table->string('classificacao',1)->default('C');
            $table->string('tipo',1)->default('F');
            $table->string('CPF_CNPJ',25);
            $table->string('email',250);
            $table->string('ativo',1)->default('S');
            $table->string('bloqueado',1)->default('N');
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
        Schema::drop('pessoas');
    }
}
