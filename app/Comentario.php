<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $primarykey = 'id';

    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function receta(){
    	return $this->belongsTo('App\Receta');
    }
}
