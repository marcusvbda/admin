<?php

namespace App\Http\Controllers\Painel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Tanques;


class tanksController extends Controller
{ 
  	public function getIndex()
  	{     
  		if(cannot('tanques','get'))
			return erro(505);
      	$tanques = Tanques::all();
      	return view('painel.tanques.index',compact('tanques'));
    }

}
