<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransferController extends Controller
{
    public function Transfers(){
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 50;
        $data = DB::table('transfers AS t')
            ->join('teams AS tm', 't.team_id', '=', 'tm.id')
            ->join('players AS p', 't.player_id', '=', 'p.id')
            ->join('countries AS c', 'p.country_id', '=', 'c.id')
            ->select('p.nick', 'tm.team_name as new_team', 'tm.team_logo as new_team_logo', 'c.country_name as country', 'c.country_flag as country_flag', 'start', 'end', 'updated');
        $data = $data->orderBy('updated', 'desc');
        $data = $data->limit($limit);
        $data = $data->get();
        foreach($data as $transfer){
            $transfer->old_team = 'Free Agent';
            $transfer->old_team_logo = 'img/icons/freeagent.png';
            if($transfer->end){
                $transfer->old_team = $transfer->new_team;
                $transfer->old_team_logo = $transfer->new_team_logo;
                $transfer->new_team = 'Free Agent';
                $transfer->new_team_logo = 'img/icons/freeagent.png';
            }
        }
        return json_decode($data);
    }
}
