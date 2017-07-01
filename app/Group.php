<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='group';
    protected $fillable = ['group_name', 'tournament_id', 'team_id'];
    public $timestamps = false;
}
