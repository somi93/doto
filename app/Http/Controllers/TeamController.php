<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use DB;

class TeamController extends Controller
{
    public function Teams(){
        $active = isset($_REQUEST['active']) ? (int)$_REQUEST['active'] : null;
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
        $data = $data->orderBy('points', 'desc');
        $data = $data->get();
        foreach($data as $team){
            $team->players = $this->TeamPlayers($team->id);
        }
        return json_decode($data);
    }

    public function TeamPlayers($team){
        $players = [];
        $player = [];
        $data = DB::table('players AS p')
            ->join('countries AS c', 'p.country_id', '=', 'c.id')
            ->where('team_id', $team)
            ->select('first_name', 'last_name', 'nick', 'player_photo', 'c.country_name as country', 'c.country_flag as country_flag')->get();
        foreach($data as $player){
            array_push($players, (object) $player);
        }
        return $players;
    }
}
