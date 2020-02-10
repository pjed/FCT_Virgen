<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class responsable extends Model {

    protected $primaryKey = ['dni'];
    public $incrementing = false;
    protected $keyType = ['string'];

}
