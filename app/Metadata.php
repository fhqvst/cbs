<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * A multi-purpose class modelling any form of metadata.
 *
 * Class Metadata
 * @package App
 */
class Metadata extends Model
{

    protected $fillable = ['instrument_id', 'key', 'value', 'created_at'];
    protected $table = 'metadata';

    public function instrument()
    {
        return $this->belongsTo('App\Instrument');
    }

}
