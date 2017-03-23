<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Todolist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todolist', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('descricao',50);
            $table->string('checked',1)->default("N");
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                    ->on('usuarios');  
                           
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
        Schema::drop('todolist');
    }
}
