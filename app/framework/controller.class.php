<?php
use Jenssegers\Blade\Blade;
class Controller
{
    private $blade;
    
    public function model($model)
    {
        $model.='Model';
        require_once  __CODE__.'/models/' . $model . '.php';
        return new $model();
    }

    public function view($view,array $dados = [])
    {
        Controller::limpar_cache();
        $this->blade = new Blade( __CODE__.'/views/', __PUBLIC__.'cache');
        echo $view = $this->blade->make($view,$dados)->render();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function limpar_cache()
    {
        if(__MODO_DESENVOLVEDOR__)
        {   
            $diretorio = scandir(__PUBLIC__.'cache');
            foreach ($diretorio as $arquivo) 
            {
                if(($arquivo!='..')&&($arquivo!='.'))
                    unlink(__PUBLIC__.'cache/'.$arquivo);
            }
        }
    }

    public function exec($controller,$metodo,$parametros = [])
    {
        if(file_exists(__CODE__.'controllers/'.$controller.'.php'))
        {
            require_once __CODE__.'controllers/'.$controller.'.php';
            if(method_exists($controller, $metodo))
                return call_user_func_array(array($controller,$metodo),$parametros);
            else
                return 'METODO NÃO EXISTE';
        }
        else
            return 'CONTROLLER NÃO EXISTE';
    }
  


}
