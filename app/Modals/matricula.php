<?php

namespace App\Modals;

use Illuminate\Database\Eloquent\Model;

class matricula extends Model {

    protected $table = 'matriculados';
    protected $primaryKey = ['idmatriculados'];
    public $incrementing = true;

}
