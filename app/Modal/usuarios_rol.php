<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class usuarios_rol extends Model {
    protected $table = 'usuarios_roles'; //Por defecto tomaría la tabla 'personas'.
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.

}
