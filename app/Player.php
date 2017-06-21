<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table='players';
    protected $fillable = ['first_name', 'last_name', 'nick', 'player_photo', 'country_id', 'team_id'];
    public $timestamps = false;
}
