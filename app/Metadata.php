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

    protected $fillable = ['instrument_id', 'key', 'value', 'logged_at', 'created_at'];
    protected $table = 'metadata';

    public function instrument()
    {
        return $this->belongsToMany('App\Instrument', 'instruments_metadata');
    }

}
