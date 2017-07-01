@extends('layouts.default')

@section('content')
    <div class="col-sm-12" ng-controller="team">
        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px">
            <div class="col-sm-3" style="width:auto;max-width:25%">
                <img src="../@{{ team.team_logo }}" style="max-width:100%;height:96px;">
            </div>
            <div class="col-sm-4" style="padding-top:10px;">
                <span style="color:#ccc;font:32px Helvetica;">@{{ team.team_name }}</span>
                <div class="clear"></div>
                <img src="../@{{ team.country_flag }}" style="height:24px;">
                <span style="color:#ccc;font:14px Helvetica;margin-left:5px;margin-top:5px;">@{{ team.country }}</span>
            </div>
            <div class="col-sm-5" style="padding-top:10px;float:right">
                <div style="float:right;">
                    <span style="color:#ccc;font:20px Helvetica;">Points</span>
                    <div class="clear"></div>
                    <span style="color:#ccc;font:14px Helvetica;">@{{ team.points }}</span>
                </div>
                <div style="float:right;margin-right:25px;">
                    <span style="color:#ccc;font:20px Helvetica;">Ranking</span>
                    <div class="clear"></div>
                    <span style="color:#ccc;font:14px Helvetica;">35</span>
                </div>
                <div style="float:right;margin-right:25px;">
                    <span style="color:#ccc;font:20px Helvetica;">Record</span>
                    <div class="clear"></div>
                    <span style="color:#ccc;font:14px Helvetica;">74W/43L/10D</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px;margin-top:20px">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Current Roster</h4>
            </div>
            <div class="col-sm-4" style="margin:10px 0px" ng-repeat="player in team.roster">
                <div class="col-sm-6" style="width:auto;max-width:50%;padding:0px">
                    <img src="../@{{ player.photo }}" style="height:64px;max-width:100%">
                </div>
                <div class="col-sm-6" style="padding: 10px 0px;">
                    <a href="/players/@{{ player.id }}">
                        <span style="color:#ccc;font:14px Helvetica;">@{{ player.nick }}</span>
                    </a>
                    <div class="clear"></div>
                    <img src="../@{{ player.country_flag }}" style="height:16px;">
                    <span style="color:#ccc;font:14px Helvetica;margin-left:5px;margin-top:5px;">@{{ player.country_name }}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12" style="margin-top:20px;background:#292929;border-radius:10px;">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Past Matches</h4>
            </div>
            <div class="col-sm-12" style="padding: 3px;" ng-repeat="match in matches">
                <div class="col-sm-1" style="width:10%;">
                    <span style="color:#ccc">@{{ match.start_time }}</span>
                </div>
                <div class="col-sm-3 text-dotted">
                  <span style="color:#ccc;margin-left:15px;white-space: nowrap;">
                    <a href="#">@{{ match.tournament_name }}</a>
                  </span>
                </div>
                <div class="col-sm-3" style="width: 23%">
                    <span style="color:#ccc">@{{ match.team1.name }}</span>
                </div>
                <div class="col-sm-1">
                    <span style="color:#a74643" ng-if="team.id == match.team1.id && match.team1.score < match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                    </span>
                    <span style="color:#46a743" ng-if="team.id == match.team1.id && match.team1.score > match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                    </span>
                    <span style="color:#a74643" ng-if="team.id == match.team2.id && match.team1.score > match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                    </span>
                    <span style="color:#46a743" ng-if="team.id == match.team2.id && match.team1.score < match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                    </span>
                    <span style="color:#ccc" ng-if="match.team1.score == match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                    </span>
                </div>
                <div class="col-sm-3" style="text-align:right; width: 23%">
                    <span style="color:#ccc">@{{ match.team2.name }}</span>
                </div>
                <div class="col-sm-1" style="text-align:right">
                  <span style="color:#ccc">
                    <a href="/match/@{{ match.id }}">details</a>
                  </span>
                </div>
        </div>
        </div>
        <div class="col-sm-12" style="background:#292929;border-radius:8px;padding:8px;margin-top:20px">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Trophies</h4>
            </div>
            <table class="table table-responsive table-bordered">
                <tbody>
                    <tr>
                        <th style="color:#888;border:1px solid#666">Date</th>
                        <th style="color:#888;border:1px solid#666">Tournament</th>
                        <th style="color:#888;border:1px solid#666">Category</th>
                        <th style="color:#888;border:1px solid#666">Place</th>
                    </tr>
                    <tr ng-repeat="trophy in team.trophies">
                        <td style="border:1px solid#666">
                            <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.date }}</span>
                        </td>
                        <td style="border:1px solid#666">
                            <a href="#">
                                <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.tournament_name }}</span>
                            </a>
                        </td>
                        <td style="border:1px solid#666">
                            <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.category }}</span>
                        </td>
                        <td style="border:1px solid#666">
                            <span style="color:#ccc;font:14px Helvetica;">@{{ trophy.position }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
@endsection


@section('scripts')
    <script src="{{ asset('js/angular/controller/team.js') }}"></script>
@endsection