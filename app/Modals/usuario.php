<?php

namespace App\Modals;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model {
    protected $primaryKey = ['dni']; 
    public $incrementing = false;
    protected $keyType = ['string'];  
    
}
