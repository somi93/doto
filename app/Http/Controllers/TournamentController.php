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
            $tournament->start = date(DATE_ATOM, $tournament->start);
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

    public function BasicInfo($id){
        $data = DB::table('tournaments');
        $data = $data->where('id', $id);
        $data = $data->orderBy('start', 'desc');
        $data = $data->select('id', 'tournament_name', 'tournament_logo', 'tournament_type', 'number_of_participants', 'strength', 'start');
        $data = $data->get();
        foreach($data as $tournament){
            $tournament->start = date(DATE_ATOM, $tournament->start);
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
        $team = new TeamController;
        $data = DB::table('tournament_participants AS tp')
        ->join('tournaments AS t', 'tp.tournament_id', '=', 't.id')
        ->join('teams AS tm', 'tp.team_id', '=', 'tm.id');
        $data = $data->where('tournament_id', $tournament->id);
        $data = $data->select('tournament_name', 'team_name', 'team_logo', 'tm.id');
        $data = $data->get();
        $participants = [];
        foreach($data as $participant){
            $roster = $team->Roster($participant->id, $tournament->start);
            array_push($participants, (object) array('team_name' => $participant->team_name, 'team_logo' => $participant->team_logo, 'roster' => $roster));
        }
        return $participants;
    }

    public function Trophies($tournament){
        $data = DB::table('team_trophies AS t')->join('teams AS tm', 't.team_id', '=', 'tm.id');
        $data = $data->where('t.tournament_id', $tournament);
        $data = $data->select('t.position', 'tm.team_name', 'tm.team_logo');
        $data = $data->get();
        return $data;
    }

    public function Insert(Request $request){
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        $tournament = new Tournament();
        $tournament->tournament_name = $data->name;
        $tournament->tournament_logo = '';
        $tournament->tournament_type = $data->type;
        $tournament->number_of_participants = $data->numberOfTeams;
        $tournament->strength = $data->tier;
        $tournament->start = strtotime($data->start);
        $tournament->end = strtotime($data->end);
        $tournament->parent_id = $data->qualifier == '' ? null : $data->qualifier;
        $tournament->save();
        return 'Success';
    }
}
