<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model {

    public function positions()
    {
        return $this->belongsToMany('App\Positions');
    }

}
