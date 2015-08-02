<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {

    protected $fillable = ['user_id', 'own_capital', 'balance', 'profit', 'total_value'];

    public function positions()
    {
        return $this->hasMany('App\Positions');
    }

}