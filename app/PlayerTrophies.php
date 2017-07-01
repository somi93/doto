<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerTrophies extends Model
{
    protected $table='player_trophies';
    protected $fillable = ['player_id', 'tournament_id', 'team_id', 'position'];
    public $timestamps = false;
}
