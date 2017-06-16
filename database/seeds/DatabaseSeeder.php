<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class DatabaseSeeder extends Seeder
{    
   public function run()
   {
        Eloquent::unguard();    
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call('Limpar');
        $this->call('TenantSeed');
        $this->call('ModulosSeed');
        $this->call('FuncoesSeed');
        $this->call('GruposAcessoSeed');
        $this->call('PermissoesSeed');
        $this->call('GruposPermissoesSeed');
        $this->call('CorProfileSeed');        
        $this->call('UsuariosSeed');
        $this->call('ParametrosSeed');
        $this->call('RedesSeed');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
   }
}



class CorProfileSeed extends Seeder 
{
    public function run()
    {
        DB::table('cor_profile')->insert(['cor' => '#4f5f6f','descricao'=>'dimgray']);
        DB::table('cor_profile')->insert(['cor' => '#7d8880','descricao'=>'gray']);
        DB::table('cor_profile')->insert(['cor' => '#ff6161','descricao'=>'tomato']);
        DB::table('cor_profile')->insert(['cor' => '#008000','descricao'=>'green']);
        DB::table('cor_profile')->insert(['cor' => '#6abdec','descricao'=>'skyblue']);
        DB::table('cor_profile')->insert(['cor' => '#fa73f5','descricao'=>'violet']);
    }
}


class Limpar extends Seeder
{    
   public function run()
   {
        DB::table('tenant')->truncate();
        DB::table('usuarios')->truncate();
        DB::table('funcoes')->truncate();
        DB::table('permissoes')->truncate();
        DB::table('grupo_acesso_permissoes')->truncate();
        DB::table('grupos_acesso')->truncate();
        DB::table('grupo_acesso_permissoes')->truncate();
        DB::table('modulos')->truncate();
        DB::table('parametros')->truncate();
   }
}

class GruposPermissoesSeed extends Seeder
{
    public function run()
    {
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 1,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 2,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 3,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 4,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 5,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 6,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 7,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 8,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 9,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 10,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 11,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 12,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 13,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 14,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 15,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 16,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 17,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 18,'grupo_acesso_id'=>1,'valor'=>'S','tenant_id'=>437]);

        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 1,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 2,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 3,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 4,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 5,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 6,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 7,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 8,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 9,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 10,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 11,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 12,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 13,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 14,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 15,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 16,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 17,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 18,'grupo_acesso_id'=>2,'valor'=>'S','tenant_id'=>1426]);


        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 1,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 2,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 3,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 4,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 5,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 6,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 7,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 8,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 9,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 10,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 11,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 12,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 13,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 14,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 15,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 16,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 17,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
        DB::table('grupo_acesso_permissoes')->insert(['permissao_id' => 18,'grupo_acesso_id'=>3,'valor'=>'S','tenant_id'=>436]);
    }    
}


class TenantSeed extends Seeder 
{
    public function run()
    {
        DB::table('tenant')->insert(['id'=>437,'nome' => 'CENTRO DE SERVICOS FRANGO ASSADO -NORTE LTDA','rede_id'=>1,'razao'=>'CENTRO DE SERVICOS FRANGO ASSADO -NORTE LTDA']);
        DB::table('tenant')->insert(['id'=>1426, 'nome' => 'CARVALHO PINTO AUTOMOTIVOS E CONVENIENCIAS LTDA','rede_id'=>1,'razao'=>'CARVALHO PINTO AUTOMOTIVOS E CONVENIENCIAS LTDA']);
        DB::table('tenant')->insert(['id'=>436, 'nome' => 'CENTRO DE SERVICOS FRANGO ASSADO -NORTE LTDA','rede_id'=>1,'razao'=>'CENTRO DE SERVICOS FRANGO ASSADO -NORTE LTDA']);
    }
}

class ModulosSeed extends Seeder 
{
    public function run()
    {
        DB::table('modulos')->insert(['nome' => 'usuarios','descricao'=>'Usuários']);        
        DB::table('modulos')->insert(['nome' => 'grupos_acesso','descricao'=>'Grupos de Acesso']);
        DB::table('modulos')->insert(['nome' => 'produtos','descricao'=>'Produtos']);
        DB::table('modulos')->insert(['nome' => 'configuracoes','descricao'=>'Configurações']);
        DB::table('modulos')->insert(['nome' => 'tanques','descricao'=>'Tanques']);
        DB::table('modulos')->insert(['nome' => 'bombas','descricao'=>'Bombas']);
        DB::table('modulos')->insert(['nome' => 'abastecimentos','descricao'=>'Abastecimentos']);
        DB::table('modulos')->insert(['nome' => 'caixas','descricao'=>'Caixas']);
        DB::table('modulos')->insert(['nome' => 'multiempresa','descricao'=>'MultiEmpresa']);
        DB::table('modulos')->insert(['nome' => 'vendas','descricao'=>'Vendas']);
    }
}

class FuncoesSeed extends Seeder 
{
    public function run()
    {
        DB::table('funcoes')->insert(['descricao'=>'Administrador','tenant_id'=>437]);
        DB::table('funcoes')->insert(['descricao'=>'Administrador','tenant_id'=>1426]);
        DB::table('funcoes')->insert(['descricao'=>'Administrador','tenant_id'=>436]);
    }
}

class GruposAcessoSeed extends Seeder 
{
    public function run()
    {
        DB::table('grupos_acesso')->insert(['descricao'=>'Administrador','tenant_id'=>437]);
        DB::table('grupos_acesso')->insert(['descricao'=>'Administrador','tenant_id'=>1426]);
        DB::table('grupos_acesso')->insert(['descricao'=>'Administrador','tenant_id'=>436]);
    }
}

class PermissoesSeed extends Seeder 
{
    public function run()
    {
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>3,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'put','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>5,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>6,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>7,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>8,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>10,'nome'=>'get','descricao'=>'Ver']);





        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>3,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'put','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>5,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>6,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>7,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>8,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>10,'nome'=>'get','descricao'=>'Ver']);






        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>1,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'post','descricao'=>'Cadastrar']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'delete','descricao'=>'Excluir']);
        DB::table('permissoes')->insert(['modulo_id'=>2,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>3,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>4,'nome'=>'put','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>5,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>6,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>7,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>8,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'get','descricao'=>'Ver']);
        DB::table('permissoes')->insert(['modulo_id'=>9,'nome'=>'PUT','descricao'=>'Alterar']);
        DB::table('permissoes')->insert(['modulo_id'=>10,'nome'=>'get','descricao'=>'Ver']);
    }
}


class UsuariosSeed extends Seeder 
{
    public function run()
    {
        DB::table('usuarios')->insert([
                "senha"  =>md5('admin'),
                "nome"   =>"Administrador",
                "dt_nascimento"   =>"01-01-2017",
                "email"  =>"adm@louveira.br",
                "ativo"  =>"S",
                "funcao_id"=>1,
                "grupo_acesso_id"=>1,
                "cor_profile_id"=>1,
                'tenant_id'=>437,
                'tenant_selecionados'=>'437'
            ]);
        DB::table('usuarios')->insert([
                "senha"  =>md5('admin'),
                "nome"   =>"Administrador",
                "dt_nascimento"   =>"01-01-2017",
                "email"  =>"adm@carvalho.br",
                "ativo"  =>"S",
                "funcao_id"=>2,
                "grupo_acesso_id"=>2,
                "cor_profile_id"=>1,
                'tenant_id'=>1426,
                'tenant_selecionados'=>'1426'
            ]);
        DB::table('usuarios')->insert([
                "senha"  =>md5('admin'),
                "nome"   =>"Administrador",
                "dt_nascimento"   =>"01-01-2017",
                "email"  =>"adm@sumare.br",
                "ativo"  =>"S",
                "funcao_id"=>3,
                "grupo_acesso_id"=>3,
                "cor_profile_id"=>1,
                'tenant_id'=>436,
                'tenant_selecionados'=>'436'
            ]);
    }
}

class ParametrosSeed extends Seeder 
{
    public function run()
    {
        DB::table('parametros')->insert(['qtde_dec_dinheiro'=>2,'tenant_id'=>437]);
        DB::table('parametros')->insert(['qtde_dec_dinheiro'=>2,'tenant_id'=>1426]);
        DB::table('parametros')->insert(['qtde_dec_dinheiro'=>2,'tenant_id'=>436]);
    }
}


class RedesSeed extends Seeder 
{
    public function run()
    {
        DB::table('redes')->insert(['nome' => 'Rede Frango Assado','razao'=>'Rede Frango Assado']);
    }
}

