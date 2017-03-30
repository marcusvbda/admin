<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Input;
use App\Caixas;

class caixasController extends Controller
{ 
  	public function getIndex()
  	{   
      $caixas = Caixas::all();
      $filtro['de'] = "";
      $filtro['ate'] = "";
      $filtro['de_hora'] = "";
      $filtro['ate_hora'] = "";
      return view('painel.caixas.index',compact('caixas','filtro'));
    }

}
