<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table='transfers';
    protected $fillable = ['start', 'end', 'team_id', 'player_id'];
    public $timestamps = false;
}
