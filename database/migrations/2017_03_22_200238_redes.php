<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class Redes extends Migration
{
    public function up()
    {
        Schema::create('redes', function (Blueprint $table) 
        {
            $table->increments('id');            
            $table->string('razao',50);
            $table->string('nome',50);
            $table->timestamps();           
        });
    }
   
    public function down()
    {
        Schema::drop('redes');
    }
}