<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlayerController extends Controller
{
    public function Players(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        $data = DB::table('players AS p')
            ->join('countries AS c', 'p.country_id', '=', 'c.id')
            ->join('teams AS t', 'p.team_id', '=', 't.id')
            ->select('p.id','first_name', 'last_name' , 'nick', 'player_photo', 'team_id', 't.team_name', 't.team_logo', 'c.country_name as country', 'c.country_flag as country_flag');
        if($id){ $data->where('p.id', $id); }
        $data = $data->get();
        $data[0]->team_history = $this->teamHistory($data[0]->id);
        $data[0]->trophies = $this->Trophies($data[0]->id);
        return json_decode($data);
    }

    public function teamHistory($player){
        $data = DB::table('players AS p')
            ->join('transfers AS tr', 'tr.player_id', '=', 'p.id')
            ->join('teams AS t', 'tr.team_id', '=', 't.id')
            ->where('player_id', $player)
            ->orderBy('start', 'asc')
            ->select('tr.team_id', 't.team_name', 't.team_logo', 'start', 'end')
            ->get();
        foreach($data as $transfer){
            $matches = DB::table('matches AS m')
                ->where('start_time', '>', $transfer->start);
            if($transfer->end){ $matches = $matches->where('start_time', '<', $transfer->end); }
            $matches = $matches->where(function ($query) use ($transfer) {
                    $query->where('team1', $transfer->team_id)
                        ->orWhere('team2', $transfer->team_id);
                })
                ->select('team1', 'team2', 'team1score', 'team2score')
                ->get();

            $transfer->start = date(DATE_ATOM, $transfer->start);
            $transfer->end = $transfer->end ? date(DATE_ATOM, $transfer->end) : 'Present';
            $transfer->win = 0;
            $transfer->draw = 0;
            $transfer->lose = 0;
            foreach($matches as $match){
                if($match->team1 == $transfer->team_id){
                    if($match->team1score > $match->team2score){
                        $transfer->win++;
                    } else if($match->team1score < $match->team2score) {
                        $transfer->lose++;
                    }else{
                        $transfer->draw++;
                    }
                }else{
                    if($match->team1score > $match->team2score){
                        $transfer->lose++;
                    } else if($match->team1score < $match->team2score) {
                        $transfer->win++;
                    }else{
                        $transfer->draw++;
                    }
                }
            }
            $transfer->total_matches = count($matches);
            $transfer->trophies = $this->Trophies($player, $transfer->team_id);
            $transfer->first_place = 0;
            $transfer->second_place = 0;
            $transfer->third_place = 0;
            foreach ($transfer->trophies as $trophy){
                if($trophy->category == 1.1 || $trophy->category == 1.2){
                    $trophy->category = 'Minor';
                } else if($trophy->category == 1.3){
                    $trophy->category = 'Premier';
                } else if($trophy->category == 1.4){
                    $trophy->category = 'Major';
                }
                if($trophy->position == 1){
                    $transfer->first_place++;
                } else if($trophy->position == 2){
                    $transfer->second_place++;
                } else if($trophy->position == 3){
                    $transfer->third_place++;
                }
            }
        }
        return json_decode($data);
    }

    public function Trophies($player, $team = null){
        $data = DB::table('player_trophies AS pt')
            ->join('tournaments AS tour', 'pt.tournament_id', '=', 'tour.id')
            ->join('teams AS t', 'pt.team_id', '=', 't.id');
        $data = $data->where('pt.player_id', $player);
        if($team){ $data = $data->where('pt.team_id', $team); }
        $data = $data->orderBy('date', 'desc');
        $data = $data->select('team_name', 'team_logo', 'team_id', 'tournament_name', 'position', 'end AS date', 'strength AS category');
        $data = $data->get();
        foreach($data as $trophy){
            $trophy->date = date(DATE_ATOM, $trophy->date);
        }
        return $data;
    }
}
