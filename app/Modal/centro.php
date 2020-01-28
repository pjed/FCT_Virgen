<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class centro extends Model {
    protected $primaryKey = ['COD'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['string'];   //Indicamos que la clave no es entera.
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.

}
