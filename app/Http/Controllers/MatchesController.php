<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\TournamentController;

class MatchesController extends Controller
{
    public function Matches(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        $team_id = isset($_REQUEST['team']) ? $_REQUEST['team'] : null;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
        $team = new TeamController;
        $tournament = new TournamentController;
        $data = DB::table('matches AS m')
            ->join('teams AS t1', 'm.team1', '=', 't1.id')
            ->join('teams AS t2', 'm.team2', '=', 't2.id')
            ->join('tournaments AS tr', 'm.tournament_id', '=', 'tr.id');
        if($id){ $data = $data->where('m.id', $id); }
        if($team_id){ $data = $data->where('m.team1', $team_id); }
        if($team_id){ $data = $data->orWhere('m.team2', $team_id); }
        $data = $data->orderBy('start_time', 'desc');
        $data = $data->limit($limit);
        $data = $data->select('m.id', 'tr.id as tour_id', 't1.id as team1id', 't2.id as team2id', 'm.start_time', 'm.team1score', 'm.team2score', 'm.team1points', 'm.team2points', 't1.team_name as team1', 't1.team_logo as team1logo', 't2.team_name as team2', 't2.team_logo as team2logo');
        $data = $data->get();
        $data = json_decode($data);
        foreach($data as $match){
            $time = $match->start_time;
            $match->start_time = date(DATE_ATOM, $match->start_time);
            $team1 = [];
            $team1['id'] = $match->team1id;
            $team1['name'] = $match->team1;
            $team1['logo'] = $match->team1logo;
            $team1['score'] = $match->team1score;
            $team1['points'] = $match->team1points;
            $team1 = json_decode(json_encode($team1));
            $roster1 = $team->Roster($match->team1id, $time);
            $team1->roster = $roster1;
            $match->team1 = $team1;
            $team2 = [];
            $team2['id'] = $match->team2id;
            $team2['name'] = $match->team2;
            $team2['logo'] = $match->team2logo;
            $team2['score'] = $match->team2score;
            $team2 = json_decode(json_encode($team2));
            $roster2 = $team->Roster($match->team2id, $time);
            $team2->roster = $roster2;
            $match->team2 = $team2;
            $match->tournament = $tournament->BasicInfo($match->tour_id);
            $match->encounters = $this->Encounters($match->team1id, $match->team2id);
            unset($match->team1id);
            unset($match->team2id);
            unset($match->team1logo);
            unset($match->team2logo);
            unset($match->team1score);
            unset($match->team2score);
            unset($match->team1points);
            unset($match->team2points);
        }
        return $data;
    }

    public function Encounters($team1, $team2)
    {
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 10;
        $team = new TeamController;
        $tournament = new TournamentController;
        $data = DB::table('matches AS m')
            ->join('teams AS t1', 'm.team1', '=', 't1.id')
            ->join('teams AS t2', 'm.team2', '=', 't2.id')
            ->join('tournaments AS tr', 'm.tournament_id', '=', 'tr.id');
        $data = $data->where('m.team1', $team1);
        $data = $data->where('m.team2', $team2);
        $data = $data->orderBy('start_time', 'desc');
        $data = $data->limit($limit);
        $data = $data->select('m.id', 'tr.id as tour_id', 't1.id as team1id', 't2.id as team2id', 'm.start_time', 'm.team1score', 'm.team2score', 'm.team1points', 'm.team2points', 't1.team_name as team1', 't1.team_logo as team1logo', 't2.team_name as team2', 't2.team_logo as team2logo');
        $data = $data->get();
        $data = json_decode($data);
        foreach($data as $match){
            $match->start_time = date(DATE_ATOM, $match->start_time);
            $team1 = [];
            $team1['id'] = $match->team1id;
            $team1['name'] = $match->team1;
            $team1['logo'] = $match->team1logo;
            $team1['score'] = $match->team1score;
            $team1 = json_decode(json_encode($team1));
            $match->team1 = $team1;
            $team2 = [];
            $team2['id'] = $match->team2id;
            $team2['name'] = $match->team2;
            $team2['logo'] = $match->team2logo;
            $team2['score'] = $match->team2score;
            $team2 = json_decode(json_encode($team2));
            $match->team2 = $team2;
            $match->tournament = $tournament->BasicInfo($match->tour_id);
            unset($match->team1id);
            unset($match->team2id);
            unset($match->team1logo);
            unset($match->team2logo);
            unset($match->team1score);
            unset($match->team2score);
            unset($match->team1points);
            unset($match->team2points);
        }
        return $data;
    }
}
