<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;

class TournamentController extends Controller
{
    public function Tournaments(){
        $main = isset($_REQUEST['main']) ? $_REQUEST['main'] : null;
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        $data = DB::table('tournaments');
        if($main){ $data->where('parent_id', NULL); }
        if($id){ $data->where('id', $id); }
        $data = $data->orderBy('start', 'desc');
        $data = $data->select('id', 'tournament_name', 'tournament_logo', 'tournament_type', 'number_of_participants', 'strength', 'start');
        $data = $data->get();
        foreach($data as $tournament){
            $tournament->participants = $this->Participants($tournament);
            $tournament->trophies = $this->Trophies($tournament->id);
            if($tournament->strength == 1.1 || $tournament->strength == 1.2){
                $tournament->strength = 'Minor';
            } else if($tournament->strength == 1.3){
                $tournament->strength = 'Premier';
            } else if($tournament->strength == 1.4){
                $tournament->strength = 'Major';
            }
        }
        return json_decode($data);
    }

    public function Participants($tournament){
        $data = DB::table('tournament_participants AS tp')
        ->join('tournaments AS t', 'tp.tournament_id', '=', 't.id')
        ->join('teams AS tm', 'tp.team_id', '=', 'tm.id');
        $data = $data->where('tournament_id', $tournament->id);
        $data = $data->select('tournament_name', 'team_name', 'team_logo', 'tm.id');
        $data = $data->get();
        $participants = [];
        foreach($data as $participant){
            $roster = $this->Roster($participant->id, $tournament->start);
            array_push($participants, (object) array('team_name' => $participant->team_name, 'team_logo' => $participant->team_logo, 'roster' => $roster));
        }
        return $participants;
    }

    public function Roster($team, $time){
        $data = DB::table('transfers AS t')
                    ->join('players AS p', 't.player_id', '=', 'p.id')
                    ->join('countries AS c', 'p.country_id', '=', 'c.id');
        $data = $data->where('t.team_id',$team);
        $data = $data->where('start', '<', $time);
        $data = $data->where(function ($query) use ($time) {
            $query->whereNull('end')
                  ->orWhere('end', '>', $time);
        });
        $data = $data->select('p.first_name', 'p.last_name', 'p.nick', 'c.country_name', 'c.country_flag');
        $data = $data->get();
        return $data;
    }

    public function Trophies($tournament){
        $data = DB::table('team_trophies AS t')->join('teams AS tm', 't.team_id', '=', 'tm.id');
        $data = $data->where('t.tournament_id',$tournament);
        $data = $data->select('t.position', 'tm.team_name', 'tm.team_logo');
        $data = $data->get();
        return $data;
    }
}
