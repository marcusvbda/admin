<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use App\Abastecimentos;
use Config;
use JasperPHP\JasperPHP;
class testeController extends Controller
{ 
  	public function getIndex()
    {
    	$input =  public_path() . '/relatorios/templates/_modelo_abastecimento.jrxml';
    	$output = public_path() . '/relatorios/temp/' . time();
		$jasper = new JasperPHP;
		$jasper->compile($input)->execute();

		$input  = public_path() . '/relatorios/templates/_modelo_abastecimento.jasper';

		$jasper->process(
			$input,
			$output,
			array('pdf'),
			array(),		
			// array(),	
		    $this->getDatabaseConfig(),
			false,
			false
		)->execute();

		$file = $output . '.pdf';
        $path = $file;
        
        if (!file_exists($file)) 
            return abort(404);
        $file = file_get_contents($file);
        unlink($path);
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline;');
	}

	 public function getDatabaseConfig()
    {
        return [
            'driver'   => 'mysql',
            'host'     => 'localhost',
            'port'     => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'alive_admin',
            'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/lavela/phpjasper/src/JasperStarter/jdbc'),
        ];
    }	

}
