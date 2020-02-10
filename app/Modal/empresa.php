<?php

namespace App\Modal;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model {

    protected $primaryKey = ['cif'];
    public $incrementing = false;
    protected $keyType = ['string'];

}
