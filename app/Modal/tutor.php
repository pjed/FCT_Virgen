<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class tutor extends Model {

    protected $table = 'tutores';
    protected $primaryKey = ['idtutores'];
    public $incrementing = false;

}
