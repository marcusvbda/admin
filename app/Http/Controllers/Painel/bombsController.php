<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Bombas;

class bombsController extends Controller
{ 
  	public function getIndex()
  	{     
  		if(cannot('bombas','get'))
			return erro(505);
      	$bombas = Bombas::groupBy('bomba')->get();
      	return view('painel.bombas.index',compact('bombas'));
    }

}
