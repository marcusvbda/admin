<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class bomba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bomba', function (Blueprint $table) 
        {
            $table->increments('id');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  

            $table->integer('codigo');
            $table->integer('numero');
            $table->integer('bomba');
            $table->integer('tanque_codigo');
            $table->double('encerrante',15,8); 
            

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
        Schema::drop('bomba');
    }
}
