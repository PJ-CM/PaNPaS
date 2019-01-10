<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $table = 'ingredientes';
    protected $primarykey = 'id';


	public function panaderias(){
    	return $this->belongsToMany('App\Panaderia');
    }

	public function recetas(){
    	return $this->belongsToMany('App\Receta');
    }

}
