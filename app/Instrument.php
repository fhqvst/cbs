<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model {

    protected $fillable = ['symbol', 'name', 'label', 'nordnet_id', 'market_id', 'sector', 'isin_code'];

    public function positions()
    {
        return $this->belongsToMany('App\Positions');
    }

}
