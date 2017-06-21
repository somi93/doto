@extends('layouts.default')

@section('content')
    <div ng-controller="transfers">
        <div class="col-sm-12 table-rank-container">
            <table class="table table-rank" style="margin-left:0">
                <tbody>
                <tr>
                    <th>Time</th>
                    <th>Player</th>
                    <th colspan="2">From</th>
                    <th colspan="2">To</th>
                </tr>
                <tr data-id="6" class="rankingTeam" ng-repeat="transfer in transfers">
                    <td align="center">@{{ transfer.updated*1000 | date : mediumDate }}</td>
                    <td align="center">
                        <span>@{{ transfer.nick }}</span>
                    </td>
                    <td style="max-width:40px;" align="center">
                        <img src="@{{ transfer.old_team_logo }}" style="height:24px;max-width:100%">
                    </td>
                    <td><span><a href="#">@{{ transfer.old_team }}</a></span></td>
                    <td style="max-width:40px;" align="center">
                        <img src="@{{ transfer.new_team_logo }}" style="height:24px;max-width:100%">
                    </td>
                    <td>
                          <span>
                            <a href="#">@{{ transfer.new_team }}</a>
                          </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="js/angular/controller/transfers.js"></script>
@endsection