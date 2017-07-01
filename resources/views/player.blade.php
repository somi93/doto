@extends('layouts.default')

@section('content')
    <div class="col-sm-12" ng-controller="player">

        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px">
            <div class="col-sm-3" style="width:auto;max-width:25%">
                <img src="../@{{ player.player_photo }}" style="max-width:100%;height:96px;">
            </div>
            <div class="col-sm-4" style="padding-top:10px;">
                <span style="color:#ccc;font:32px Helvetica;">@{{ player.nick }}</span>
                <div class="clear"></div>
                <img src="../@{{ player.country_flag }}" style="height:24px;">
                <span style="color:#ccc;font:14px Helvetica;margin-left:5px;margin-top:5px;">@{{ player.country }}</span>
            </div>
            <div class="col-sm-6" align="right">
                <a href="teams/@{{ player.team_id }}">
                    <span style="color:#ccc;font:24px Helvetica;margin-left:5px;margin-top:5px;">@{{ player.team_name }}</span>
                    <img src="../@{{ player.team_logo }}" style="height:100px;">
                </a>
            </div>
        </div>

        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px;margin-top:20px">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Playing History</h4>
            </div>
            <table class="table table-responsive table-bordered">
                <tbody><tr>
                    <th style="color:#888;border:1px solid#666">Start</th>
                    <th style="color:#888;border:1px solid#666">End</th>
                    <th style="color:#888;border:1px solid#666">Team</th>
                    <th style="color:#888;border:1px solid#666">Played</th>
                    <th style="color:#888;border:1px solid#666">Won</th>
                    <th style="color:#888;border:1px solid#666">Draw</th>
                    <th style="color:#888;border:1px solid#666">Lose</th>
                    <th style="color:#888;border:1px solid#666" align="center"><img src="../img/icons/Gold.png" style="height:24px;"></th>
                    <th style="color:#888;border:1px solid#666" align="center"><img src="../img/icons/Silver.png" style="height:24px;"></th>
                    <th style="color:#888;border:1px solid#666" align="center"><img src="../img/icons/Bronze.png" style="height:24px;"></th>
                </tr>
                <tr ng-repeat="team in player.team_history">
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.start }}</span>
                    </td>
                    <td style="border:1px solid#666">
				        <span style="color:#ccc;font:14px Helvetica;">@{{ team.end }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <a href="">
                            <img src="../@{{ team.team_logo }}" style="height:24px;">
                            <span style="color:#ccc;font:14px Helvetica;">@{{ team.team_name }}</span>
                        </a>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.total_matches }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.win }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.draw }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.lose }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.first_place }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.second_place }}</span>
                    </td>
                    <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ team.third_place }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px;margin-top:20px">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Trophies</h4>
            </div>
            <table class="table table-responsive table-bordered">
                <tbody>
                    <tr>
                        <th style="color:#888;border:1px solid#666">Date</th>
                        <th style="color:#888;border:1px solid#666">Team</th>
                        <th style="color:#888;border:1px solid#666">Tournament</th>
                        <th style="color:#888;border:1px solid#666">Place</th>
                    </tr>
                    <tr ng-repeat="trophy in player.trophies">
                        <td style="border:1px solid#666">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.date }}</span>
                        </td>
                        <td style="border:1px solid#666">
                            <a href="/teams/@{{ trophy.team_id }}">
                                <img src="../@{{ trophy.team_logo }}" style="height:24px;">
                                <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.team_name }}</span>
                            </a>
                        </td>
                        <td style="border:1px solid#666">
                            <a href="#">
                                <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.tournament_name }}</span>
                            </a>
                        </td>
                        <td style="border:1px solid#666">
                            <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.position }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/angular/controller/player.js') }}"></script>
@endsection