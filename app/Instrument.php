<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Instrument extends Model {

    protected $fillable = ['symbol', 'name', 'label', 'nordnet_id', 'listing_id', 'sector', 'isin_code'];

    public function positions()
    {
        return $this->belongsToMany('App\Positions');
    }

    public function markets()
    {
        return $this->belongsToMany('App\Market', 'instruments_markets');
    }

    public function metadata() {
        return $this->belongsToMany('App\Metadata', 'instruments_metadata');
    }

    public function quotes() {
        return $this->hasMany('App\Quote');
    }

}
