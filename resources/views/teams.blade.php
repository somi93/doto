@extends('layouts.default')

@section('content')
    <div ng-controller="teams">
        <div class="col-sm-6 table-rank-container">
            <table class="table table-rank" style="margin-left:0">
                <tbody>
                    <tr>
                        <th colspan="4">
                            <div data-id="0" style="width:20%;float:left;text-decoration: underline;">All</div>
                            <div style="width:20%;float:left" ng-repeat="region in regions">@{{ region.region_name }}</div>
                        </th>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <th colspan="2">Team</th>
                        <th>Points</th>
                    </tr>
                    <tr ng-click="changeLeadTeam(team)" class="rankingTeam" ng-repeat="team in teams">
                        <td style="width:20px;" align="center">@{{ $index+1 }}.</td>
                        <td style="max-width:40px;" align="center">
                            <img src="@{{ team.team_logo }}" style="height:24px;max-width:100%">
                        </td>
                        <td>
                          <span>
                            <a href="#">@{{ team.team_name }}</a>
                          </span>
                        </td>
                        <td style="width:24px;" align="center">
                            <span>@{{ team.points }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-12 team-banner">
                <div class="col-sm-4 team-banner-logo" align="center">
                    <img src="@{{ leadTeam.team_logo }}" style="max-width:100%;height:110px;">
                </div>
                <div class="col-sm-8" style="padding-top:10px;">
                    <div class="col-sm-12">
                        <div class="col-sm-12 team-banner-info">
                            <a href="teams/@{{ leadTeam.id }}">
                                <span style="font-size:28px;">@{{ leadTeam.team_name }}</span></a>
                            <div class="clear"></div>
                            <img src="@{{ leadTeam.country_flag }}" style="height:24px;">
                            <span style="font-size:13px;margin-left:5px;margin-top:5px;">@{{ leadTeam.country }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-sm-12" style="padding-top:10px;float:right">
                        <div class="col-sm-4">
                            <span style="font-size:17px;">Points</span>
                            <div class="clear"></div>
                            <span style="font-size:12px;">@{{ leadTeam.points }}</span>
                        </div>
                        <div class="col-sm-4">
                            <span style="font-size:17px;">Ranking</span>
                            <div class="clear"></div>
                            <span style="font-size:12px;">1</span>
                        </div>
                        <div class="col-sm-4">
                            <span style="font-size:17px;">Record</span>
                            <div class="clear"></div>
                            <span style="font-size:12px;">72W/38L/6D</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 team-banner no-padding current-roster" style="margin-top:20px">
                <div class="col-sm-12 banner-header" align="center">
                    <h4 style="color:#ccc;">Current Roster</h4>
                </div>
                <div class="col-sm-4" style="margin:10px 0px" ng-repeat="player in leadTeam.roster">
                    <div class="col-sm-6 roster-image">
                        <img src="@{{ player.photo }}">
                    </div>
                    <div class="col-sm-6 roster-info">
                        <img src="@{{ player.country_flag }}" style="height:16px;">
                        <div class="clear"></div>
                        <a href="/players/@{{ player.id }}">
                            <span style="font-size:14px;">@{{ player.nick }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 team-banner no-padding" style="margin-top: 20px">
                <div class="col-sm-12 banner-header" align="center">
                    <h4 style="color:#ccc;">Past Matches</h4>
                </div>
                <div class="col-sm-12 team-matches" ng-repeat="match in leadTeamMatches">
                    <div class="col-sm-1" align="center" style="padding:0; width:13%;">
                        <span style="color:#ccc;font-size:11px">@{{ match.start_time }}</span>
                    </div>
                    <div class="col-sm-1" align="center" style="padding:0">
                        <img style="height:20px;max-width:100%" src="@{{ match.team1.logo }}">
                    </div>
                    <div class="col-sm-4" style="padding-left:5px; width:30%">
                        <span style="color:#ccc">@{{ match.team1.name }}</span>
                    </div>
                    <div class="col-sm-4" style="text-align:right;padding-right:5px; width:30%">
                        <span style="color:#ccc;">@{{ match.team2.name }}</span>
                    </div>
                    <div class="col-sm-1" align="center" style="padding:0">
                        <img style="height:20px;max-width:100%" src="@{{ match.team2.logo }}">
                    </div>
                    <div class="col-sm-1" align="center">
                        <span style="color:#a74643" ng-if="leadTeam.id == match.team1.id && match.team1.score < match.team2.score">
                            @{{ match.team1.score }}:@{{ match.team2.score }}
                        </span>
                        <span style="color:#46a743" ng-if="leadTeam.id == match.team1.id && match.team1.score > match.team2.score">
                            @{{ match.team1.score }}:@{{ match.team2.score }}
                        </span>
                        <span style="color:#a74643" ng-if="leadTeam.id == match.team2.id && match.team1.score > match.team2.score">
                            @{{ match.team1.score }}:@{{ match.team2.score }}
                        </span>
                        <span style="color:#46a743" ng-if="leadTeam.id == match.team2.id && match.team1.score < match.team2.score">
                            @{{ match.team1.score }}:@{{ match.team2.score }}
                        </span>
                        <span style="color:#ccc" ng-if="match.team1.score == match.team2.score">
                        @{{ match.team1.score }}:@{{ match.team2.score }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="js/angular/controller/teams.js"></script>
@endsection