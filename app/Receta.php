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

    public function users(){ //usuarios que han dado favorito a la receta
        return $this->belongsToMany('App\User');
    }

    public function comentarios(){
    	return $this->hasMany('App\Comentario');
    }
}
