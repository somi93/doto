<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use DB;

class TeamController extends Controller
{
    public function Teams(){
        $active = isset($_REQUEST['active']) ? (int)$_REQUEST['active'] : null;
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        $data = DB::table('teams AS t')
            ->join('countries AS c', 't.country_id', '=', 'c.id')
            ->join('regions AS r', 't.region_id', '=', 'r.id')
            ->select('t.id', 't.team_name', 't.prefix', 't.team_logo', 't.points', 't.active', 'c.country_name as country', 'c.country_flag as country_flag', 'r.region_name as region');
        if($active){
            if($active != 1 && $active != 0){
                return 'Error. Invalid active parameter!';
            } else{
                $data = $data->where('active', $active);
            }
        }
        if($id){ $data->where('t.id', $id); }
        $data = $data->orderBy('points', 'desc');
        $data = $data->get();
        foreach($data as $team){
            $team->roster = $this->Roster($team->id, time());
            $team->trophies = $this->Trophies($team->id);
        }
        return json_decode($data);
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
        $data = $data->select('p.id', 'p.first_name', 'p.last_name', 'p.nick', 'player_photo as photo', 'c.country_name', 'c.country_flag');
        $data = $data->get();
        return $data;
    }

    public function Trophies($team){
        $data = DB::table('team_trophies AS t')
            ->join('tournaments AS tour', 't.tournament_id', '=', 'tour.id');
        $data = $data->where('t.team_id', $team);
        $data = $data->orderBy('end', 'desc');
        $data = $data->select('tournament_name', 'position', 'end AS date', 'strength AS category');
        $data = $data->get();
        foreach($data as $tournament){
            $tournament->date = date(DATE_ATOM, $tournament->date);
            if($tournament->category == 1.1 || $tournament->category == 1.2){
                $tournament->category = 'Minor';
            } else if($tournament->category == 1.3){
                $tournament->category = 'Premier';
            } else if($tournament->category == 1.4){
                $tournament->category = 'Major';
            }
        }
        return $data;
    }

}
