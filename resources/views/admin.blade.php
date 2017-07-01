@extends('layouts.default')

@section('content')
    <div class="col-sm-12" ng-controller="admin">
        <table ng-if="mainTable == 1" align="center" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Table</th>
                    <th>Insert</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label>Match</label></td>
                    <td><button ng-click="insert('match')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Bracket</label></td>
                    <td><button ng-click="insert('bracket')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Match Result</label></td>
                    <td><button ng-click="insert('matchResult')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Team</label></td>
                    <td><button ng-click="insert('team')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Tournament</label></td>
                    <td><button ng-click="insert('tournament')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Tournament Participants</label></td>
                    <td><button ng-click="insert('tournamentParticipants')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Group</label></td>
                    <td><button ng-click="insert('group')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Player</label></td>
                    <td><button ng-click="insert('player')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>News</label></td>
                    <td><button ng-click="insert('news')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <td><label>Trophy</label></td>
                    <td><button ng-click="insert('trophy')" class="btn btn-sm btn-success">Insert</button></td>
                    <td><button class="btn btn-sm btn-primary">Update</button></td>
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>

        <div ng-if="mainTable == 0"  style="float:right;margin-bottom: 10px;">
            <button ng-click="toggleMain()" class="btn btn-default btn-sm">Back</button>
        </div>

        <table ng-if="tables[0].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[0].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[0].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[1].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[1].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[2].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[2].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[3].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[3].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[4].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <td>
                   <input type="text" ng-model="insertTournament.name" class="form form-control" placeholder="Tournament Name" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" ng-model="insertTournament.tier" class="form form-control" placeholder="Tournament Tier" />
                </td>
            </tr>
            <tr>
                <td align="left">
                    <div class="dropdown">
                        <input type="hidden" class="dropdown-value" id="insertTournamentType" />
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="tour_value">Tournament Type</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="search-box">
                                <a href="#">
                                    <input type="text" class="form form-control search-dropdown" placeholder="Search"/>
                                </a>
                            </li>
                            <li class="dropdown-item"><a href="#"><span data-id="gr">Group</span></a></li>
                            <li class="dropdown-item"><a href="#"><span data-id="grublb">Group + Upper/Lower Bracket</span></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form form-control" ng-model="insertTournament.numberOfTeams"  placeholder="Number of Teams" />
                </td>
            </tr>
            <tr>
                <td align="left">
                    <div class="dropdown">
                        <input type="hidden" class="dropdown-value" id="insertTournamentQualifier" />
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="tour_value">Qualifier for</span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="search-box">
                                <a href="#">
                                    <input type="text" class="form form-control search-dropdown" placeholder="Search"/>
                                </a>
                            </li>
                            <li class="dropdown-item" ng-repeat="tournament in mainTournaments">
                                <a href="#">
                                    <span data-id="@{{ tournament.id }}">@{{ tournament.tournament_name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Start Time</label>
                    <input type="date" ng-model="insertTournament.start" class="form form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>End Time</label>
                    <input type="date" ng-model="insertTournament.end" class="form form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <button ng-click="insertTournamentFunction()" class="btn btn-primary">Insert</button>
                </td>
            </tr>
        </table>
        <table ng-if="tables[5].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[5].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[6].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[6].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[7].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[7].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[8].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[8].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
        <table ng-if="tables[9].value == 1" class="table table-responsive table-admin table-striped table-bordered table-hover">
            <tr>
                <th>@{{ tables[9].name }}</th>
            </tr>
            <tr>
                <td>
                    @{{ tables[1].name }}
                </td>
            </tr>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/angular/controller/admin.js') }}"></script>
@endsection