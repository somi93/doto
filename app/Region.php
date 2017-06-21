<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table='regions';
    protected $fillable = ['region_name'];
    public $timestamps = false;

    public function Region()
    {
        return $this->belongsTo('App\Team');
    }
}
