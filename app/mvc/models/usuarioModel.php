<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class usuarioModel extends Eloquent
{
	protected $table     = "usuarios";
	protected $fillable  = ['id','usuario','email'];
}