@extends('layouts.default')

@section('content')
    <div class="col-sm-12" ng-controller="match">
        <div class="col-sm-12">
            <span style="color:#ccc;float:left">
              <a href="#" style="color:#ccc;">@{{ match.tournament[0].tournament_name }}</a>
            </span>
            <span style="color:#ccc;float:right">@{{ match.tournament[0].start }}</span>
        </div>
        <div class="clear"></div>
        <div class="scoreboard" style="margin-top:5px">
            <div class="col-sm-5 " style="padding-left:1%">
                <div class="matchLeftside" style="float:left;">
                    <img src="../@{{ match.team1.logo }}">
                </div>
                <div class="team1Name">
                    <a href="index.php?page=team&amp;teamid=230"><span>@{{ match.team1.name }}</span></a>
                </div>
            </div>
            <div class="col-sm-2" style="height:84px;margin-top:8px;">
                <div class="countdownHolder matchScore">
                  <span class="countHours">
                    <span class="position">
                      <span class="digit static">@{{ match.team1.score }}</span>
                    </span>
                    <span class="position" style="margin-left:10px">
                      <span class="digit static">@{{ match.team2.score }}</span>
                    </span>
                  </span>
                </div>
            </div>
            <div class="col-sm-5" style="padding-right:1%">
                <div class="matchRightside" style="float:right;">
                    <img style="float:right" src="../@{{ match.team2.logo }}">
                </div>
                <div class="team2Name">
                    <a href="index.php?page=team&amp;teamid=3"><span>@{{ match.team2.name }}</span></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="col-sm-12" style="margin-top:20px;background:#292929;border-radius:10px;padding:0px">
            <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                <h4 style="color:#ccc;">Players</h4>
            </div>
            <div class="col-sm-12" style="padding:2px">
                <div class="col-sm-6" style="text-align:left;padding-right:0;">
                    <div class="col-sm-12 match-roster" style="padding: 4px;padding-right:0;" ng-repeat="player in match.team1.roster">
                        <img src="../@{{ player.photo }}" width="32px;" height="40px">
                        <span style="color:#ccc;margin-left: 10px;font-size: 15px;">
                            <a href="../players/@{{ player.id }}">@{{ player.nick }}</a>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6" style="text-align:right;padding-left: 0">
                    <div class="col-sm-12 match-roster" style="padding: 4px;padding-left:0;" ng-repeat="player in match.team2.roster">
                        <span style="color:#ccc;margin-left: 10px;font-size: 15px;">
                            <a href="../players/@{{ player.id }}">@{{ player.nick }}</a>
                        </span>
                        <img src="../@{{ player.photo }}" width="32px;" height="40px">
                    </div>
                </div>
            </div>
        </div>
        <div class="clear">
            <div class="col-sm-12" style="margin-top:20px;background:#292929;border-radius:10px;padding:0px">
                <div class="col-sm-12" style="border-bottom:1px solid#666;padding:0;margin-bottom:5px;" align="center">
                    <h4 style="color:#ccc;">Past Encounters (@{{ match.team1wins }} - @{{ match.draws }} - @{{ match.team2wins }})</h4>
                </div>
                <div class="col-sm-12" style="padding:2px" ng-repeat="encounter in match.encounters">
                    <div class="col-sm-1" style="width: 12%;">
                        <small style="color:#ccc">@{{ encounter.start_time }}</small>
                    </div>
                    <div class="col-sm-3 text-dotted" style="width: 21%">
                      <small style="color:#ccc;margin-left:15px;white-space: nowrap;">
                        <a href="#">@{{ encounter.tournament[0].tournament_name }}</a>
                      </small>
                    </div>
                    <div class="col-sm-2">
                        <span style="color:#f45042" ng-if="encounter.team1.score < encounter.team2.score">@{{ encounter.team1.name }}</span>
                        <span style="color:#558930" ng-if="encounter.team1.score > encounter.team2.score">@{{ encounter.team1.name }}</span>
                        <span style="color:#ccc" ng-if="encounter.team1.score == encounter.team2.score">@{{ encounter.team1.name }}</span>
                    </div>
                    <div class="col-sm-1">
                        <span style="color:#ccc">@{{ encounter.team1.score }}:@{{ encounter.team2.score }}</span>
                    </div>
                    <div class="col-sm-2" style="text-align:right">
                        <span style="color:#f45042" ng-if="encounter.team1.score > encounter.team2.score">@{{ encounter.team2.name }}</span>
                        <span style="color:#558930" ng-if="encounter.team1.score < encounter.team2.score">@{{ encounter.team2.name }}</span>
                        <span style="color:#ccc" ng-if="encounter.team1.score == encounter.team2.score">@{{ encounter.team2.name }}</span>
                    </div>
                    <div class="col-sm-3" style="text-align:right">
                        <span style="color:#ccc">
                            <a href="/match/@{{ encounter.id }}">details</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/angular/controller/match.js') }}"></script>
@endsection