<?php
namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\globalModel;
use App\Acl\GruposAcesso;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use PresentableTrait;
    protected $table = 'usuarios';
    protected $fillable = ['id','serie', 'tenant_id', 'nome','apelido', 'sobrenome', 'usuario', 'dt_nascimento', 'funcao_id', 
    'grupo_acesso_id', 'email', 'sexo', 'timezone','ativo','created_at','updated_at','cor_profile_id',
    'reset_token','created_at','updated_at','senha','remember_token'];
    public function cor_profile()
    {
        return $this->hasOne('app\cor_profile','id','cor_profile_id');
    }
    public function funcao()
    {
        return $this->hasone('app\funcoes','id','funcao_id');
    }
    public function todolist()
    {
        return $this->hasMany('app\todolist','usuario_id');
    }
    public function grupo_acesso()
    {
        return $this->hasOne('App\Acl\GruposAcesso','id','grupo_acesso_id');
    }
    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'tenant_id');
    }
    public function scopeTenant($query)
    {
        return $query->where('tenant_id', '=',Auth::user()->tenant_id);
    }
    public function scopeSearch($query,$id)
    {
        return $query->where('tenant_id', '=',Auth::user()->tenant_id)->where('id','=',$id);
    } 
    public static function scopeQtde($query,$ativo = true)
    {
        if($ativo)
            $ativo="S";
        else
            $ativo="N";
        return $query->where('tenant_id', '=',Auth::user()->tenant_id)->where('ativo','=',$ativo)->count();
    }
    public static function scopePorcento($query,$qtde)
    {
        $total = $query->where('tenant_id', '=',Auth::user()->tenant_id)->count();
        if($total>0)
            $percentual = ($qtde*100) / $total;
        else
            $percentual = 0;
        return round($percentual,3);
    }
}
class cor_profile extends Model
{
    protected $table     = "cor_profile";
    protected $fillable  = ['id', 'descricao','cor'];
}
class funcoes extends globalModel
{
    protected $table     = "funcoes";
    protected $fillable  = ['id', 'descricao'];
}
class todolist extends globalModel
{
    protected $table     = "todolist";
    protected $fillable  = ['id', 'usuario_id','descricao','checked'];
}
class parametros extends globalModel
{
    protected $table     = "parametros";
    protected $fillable  = ['id','qtde_dec_dinheiro','qtde_dec_porcento','skin','fix_navbar','sidebar_collapse','moeda','versao','created_at','updated_at'];
}
class empresas extends model
{    
    protected $table     = "tenant";
    protected $fillable  = ['id'];
    public function parametro()
    {
        return $this->hasOne('App\Parametros','id');
    }
}