<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model {

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

}
