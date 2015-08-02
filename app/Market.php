<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model {

    protected $fillable = ['name', 'nordnet_id'];

    public function instrument()
    {
        return $this->hasMany('App\Instrument');
    }

}
