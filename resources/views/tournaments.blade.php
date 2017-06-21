@extends('layouts.default')

@section('content')
    <div ng-controller="tournaments">
        <div class="col-sm-12 table-rank-container">
            <table class="table table-rank" style="margin-left:0">
                <tbody>
                <tr>
                    <th style="text-align: center;">Start Date</th>
                    <th align="center">Name</th>
                    <th style="text-align: center;">Category</th>
                    <th style="text-align: center;">1st Place</th>
                    <th style="text-align: center;">2nd Place</th>
                    <th style="text-align: center;">3rd Place</th>
                </tr>
                <tr class="rankingTeam" ng-repeat="tournament in tournaments">
                    <td align="center">@{{ tournament.start*1000 | date : mediumDate }}</td>
                    <td>
                        <span>@{{ tournament.tournament_name }}</span>
                    </td>
                    <td align="center">@{{ tournament.strength }}</td>
                    <td align="center">
                        <div ng-repeat="trophy in tournament.trophies">
                            <img src="@{{ trophy.team_logo }}" style="width:24px" ng-if="trophy.position == 1">
                            <span ng-if="trophy.position == 1">@{{ trophy.team_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div ng-repeat="trophy in tournament.trophies">
                            <img src="@{{ trophy.team_logo }}" style="width:24px" ng-if="trophy.position == 2">
                            <span ng-if="trophy.position == 2">@{{ trophy.team_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div ng-repeat="trophy in tournament.trophies">
                            <img src="@{{ trophy.team_logo }}" style="width:24px" ng-if="trophy.position == 3">
                            <span ng-if="trophy.position == 3">@{{ trophy.team_name }}</span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="js/angular/controller/tournaments.js"></script>
@endsection