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
  


}
