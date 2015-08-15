<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;

class Order extends Model {

    protected $fillable = [
        'portfolio_id',
        'price',
        'volume',
        'expires_at',
        'queue_position',
        'side',
        'instrument_id',
        'status',
        'type',
        'create_at',
        'updated_at'
    ];

    public function instrument()
    {
        return $this->hasOne('App\Instrument');
    }

}
