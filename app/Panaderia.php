<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panaderia extends Model
{
    protected $table = 'panaderias';
    protected $primarykey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function ingredientes(){
    	return $this->belongsToMany('App\Ingrediente');
    }
}
