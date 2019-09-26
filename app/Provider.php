<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function adresses()
    {
        return $this->hasMany('App\Address');
    }
}
