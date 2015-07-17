<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model {

    public function instrument()
    {
        return $this->hasMany('App\Instrument');
    }

}
