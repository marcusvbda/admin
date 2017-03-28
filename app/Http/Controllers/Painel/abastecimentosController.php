<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Abastecimentos;


class abastecimentosController extends Controller
{ 
  	public function getIndex()
  	{     
  		if(cannot('abastecimentos','get'))
			return erro(505);

		$abastecimentos = Abastecimentos::all();

		return view('painel.abastecimentos.index',compact('abastecimentos'));
    }

}
