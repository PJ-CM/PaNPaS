<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
        protected $table = 'recetas';
   		protected $primarykey = 'id';

   	public function user(){
        return $this->belongsTo('App\User');
    }

    public function ingredientes(){
    	return $this->belongsToMany('App\Ingrediente');
    }

    public function comentarios(){
    	return $this->hasMany('App\Comentario');
    }
}
