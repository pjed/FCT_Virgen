<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class transporte extends Model {

    public $incrementing = true; //Para indicarle que la clave no es autoincremental.
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.

}
