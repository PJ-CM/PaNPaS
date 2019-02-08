<?php

namespace App;

use App\Contacto;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use HasApiTokens;

    //Aplicando Soft Delete al borrar registro
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'contactos';
    protected $primarykey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'correo', 'asunto', 'mensaje', 'msg_origen', 'leido',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Para obtener el total de respuestas que tenga asociadas un mensaje.
     * (ver en API/ContactController@index, línea sobre withCount())
     *
     */
    public function respuestas() {
        return $this->hasMany(Contacto::class, 'msg_origen');
    }
}
