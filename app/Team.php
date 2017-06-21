<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='teams';
    protected $fillable = ['team_name', 'team_logo', 'prefix', 'points', 'active', 'country_id', 'region_id'];
    public $timestamps = false;
}
