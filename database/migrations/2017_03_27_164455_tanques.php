<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tanques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanque', function (Blueprint $table) 
        {
            $table->increments('id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('codigo');
            $table->integer('numero');
            $table->double('capacidade',15,8); 
            $table->double('volumeatual',15,8); 
            $table->integer('produto_codigo')->unsigned();

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
        Schema::drop('tanque');
    }
}
