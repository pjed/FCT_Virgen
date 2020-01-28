<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class usuarios_rol extends Model {
    protected $table = 'usuarios_roles'; //Por defecto tomaría la tabla 'personas'.
    protected $primaryKey = ['usuarios_dni','roles_dni'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['string','integer'];   //Indicamos que la clave no es entera.
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.

}
