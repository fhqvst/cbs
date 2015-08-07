<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;

class Order extends Model {

    public function instrument()
    {
        return $this->hasOne('App\Instrument');
    }

}
