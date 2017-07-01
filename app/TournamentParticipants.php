<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentParticipants extends Model
{
    protected $table='tournament_participants';
    protected $fillable = ['tournament_id', 'team_id'];
    public $timestamps = false;
}
