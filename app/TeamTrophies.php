<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamTrophies extends Model
{
    protected $table='team_trophies';
    protected $fillable = ['tournament_id', 'team_id', 'position'];
    public $timestamps = false;
}