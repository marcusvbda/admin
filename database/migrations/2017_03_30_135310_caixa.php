<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Caixa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa', function (Blueprint $table) 
        {
            $table->increments('_id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('codigo');
            $table->integer('numero');
            $table->string('funcionario',50);
            $table->string('situacao',50);
            $table->double('valor_inicial',15,8); 
            $table->date('data_abertura')->nullable(); 
            $table->date('data_fechamento')->nullable(); 
            $table->time('hora_abertura')->nullable(); 
            $table->time('hora_fechamento')->nullable();            

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
        Schema::drop('caixa');
    }
}
