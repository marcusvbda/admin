<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GrupoAcessoPermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_acesso_permissoes', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('permissao_id')->unsigned();
            $table->foreign('permissao_id')
                ->references('id')
                    ->on('permissoes'); 
            $table->integer('grupo_acesso_id')->unsigned(); 
            $table->foreign('grupo_acesso_id')
                ->references('id')
                    ->on('grupos_acesso');   

            $table->string('valor',1)->default('S');
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')
            ->references('id')
                ->on('tenant');  
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
        Schema::drop('grupo_acesso_permissoes');
    }
}
