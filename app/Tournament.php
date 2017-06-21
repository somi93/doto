<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table='tournaments';
    protected $fillable = ['tournament_name', 'tournament_logo', 'tournament_type', 'number_of_participants', 'strength', 'start', 'end', 'parent_id'];
    public $timestamps = false;
}
