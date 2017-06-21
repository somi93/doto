<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';
    protected $fillable = ['country_name', 'country_flag'];
    public $timestamps = false;

    public function Country()
    {
        return $this->belongsTo('App\Team');
    }
}
