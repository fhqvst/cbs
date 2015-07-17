<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model {

    public function instrument()
    {
        return $this->hasOne('App\Instrument');
    }

}
