<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nome',150);
            $table->string('sobrenome',200)->nullable();
            $table->string('senha',250);
            $table->string('sexo',1)->default('M');
            $table->string('email',250)->unique();
            $table->string('timezone',200)->default('America/Sao_Paulo');
            $table->string('apelido',100)->nullable();
            $table->string('reset_token',100)->nullable();
            $table->date('dt_nascimento',250);
            $table->integer('funcao_id')->unsigned();
            $table->foreign('funcao_id')
            ->references('id')
                ->on('funcoes'); 

            $table->integer('cor_profile_id')->unsigned();
            $table->foreign('cor_profile_id')
            ->references('id')
                ->on('cor_profile');        

            $table->integer('grupo_acesso_id')->unsigned();
            $table->foreign('grupo_acesso_id')
            ->references('id')
                ->on('grupos_acesso');   

            $table->string('ativo',1)->default('S');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');    

            $table->string('tenant_selecionados',100);
            $table->string('multi_tenant',1)->default('N');


         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
