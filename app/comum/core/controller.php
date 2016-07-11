<?php
use Jenssegers\Blade\Blade;
class controller
{
    private $blade;
    
	public function model($model)
    {
    	$model.='Model';
        require_once  __DIR__.'/../../'.APP_DIR.'/mvc/models/' . $model . '.php';
        return new $model();
    }

    public function view($view,array $dados = [])
    {
        // $this->limpaCacheBlade();
        $this->blade = new Blade( __DIR__.'/../../'.APP_DIR.'/mvc/views/', __DIR__.'/../../../public/'.APP_DIR.'/cache');
        return $output = $this->blade->make($view,$dados)->render();        
    }

    private function limpaCacheBlade()
    {
        if(is_dir(__DIR__.'/../../'.APP_DIR.'/mvc/views/blade/cache'))
        {
            $diretorio = opendir( __DIR__.'/../../../public/'.APP_DIR.'/cache');
            while ($arq = readdir($diretorio)) 
            {
                if(($arq != '.') && ($arq != '..'))
                   unlink( __DIR__.'/../../../public/'.APP_DIR.'/cache'); 
            }
        }
    }



}

