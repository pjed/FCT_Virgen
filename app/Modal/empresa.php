<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model {
    protected $primaryKey = ['cif'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['string'];   //Indicamos que la clave no es entera.
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.
}
