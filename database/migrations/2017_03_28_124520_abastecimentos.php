<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Abastecimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) 
        {
            $table->increments('_id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('registro')->nullable();
            $table->integer('codigo');
            $table->integer('bomba_codigo');
            $table->integer('caixa_codigo');
            $table->double('total_dinheiro',15,8); 
            $table->double('total_litros',15,8); 
            $table->double('preco',15,8); 
            $table->date('data')->nullable(); 
            $table->time('hora')->nullable(); 
            

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
        Schema::drop('abastecimentos');
    }
}
