<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function instrument() {
        return $this->belongsTo('App\Instrument');
    }
}
