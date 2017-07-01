<?php

namespace App\Http\Controllers;

use App\Group;
use App\PlayerTrophies;
use App\Team;
use App\TeamTrophies;
use App\Tournament;
use App\TournamentParticipants;
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

    public function TourParticipants(){
        $id = $_REQUEST['id'];
        $team = new TeamController;
        $data = DB::table('tournament_participants AS tp')
            ->join('tournaments AS t', 'tp.tournament_id', '=', 't.id')
            ->join('teams AS tm', 'tp.team_id', '=', 'tm.id');
        $data = $data->where('tournament_id', $id);
        $data = $data->select('tm.id', 'team_name', 'team_logo', 'start');
        $data = $data->get();
        $participants = [];
        foreach($data as $participant){
            $participant->roster = $team->Roster($participant->id, $participant->start);
            unset($participant->start);
        }
        return $data;
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

    public function InsertParticipants()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        for($i = 0; $i < count($data->teams); $i++){
            $participant = new TournamentParticipants();
            $participant->team_id = $data->teams[$i];
            $participant->tournament_id = $data->id;
            $participant->save();
        }
        return 'Success';
    }

    public function InsertGroup()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        $group = new Group();
        $group->team_id = $data->team;
        $group->tournament_id = $data->tournament;
        $group->group_name = $data->group;
        $group->save();
        return 'Success';
    }

    public function InsertTrophy()
    {
        $data = file_get_contents('php://input');
        $data = json_decode($data);
        $team_trophy = new TeamTrophies();
        $team_trophy->team_id = $data->team;
        $team_trophy->tournament_id = $data->tournament;
        $team_trophy->position = $data->position;
        $team_trophy->save();
        $tournament = $this->BasicInfo($team_trophy->tournament_id);
        $team = new TeamController();
        $roster = $team->Roster($team_trophy->team_id, strtotime($tournament[0]->start));
        foreach($roster as $player){
            $player_trophy = new PlayerTrophies();
            $player_trophy->player_id = $player->id;
            $player_trophy->team_id = $data->team;
            $player_trophy->tournament_id = $data->tournament;
            $player_trophy->position = $data->position;
            $player_trophy->save();
        }
        return 'Success';
    }

}
