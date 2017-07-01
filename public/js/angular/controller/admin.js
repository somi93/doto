app.controller('admin', function ($http, $scope, BASE_URL) {

    //Fetch team
    $http.get(BASE_URL + 'api/tournaments?main=true')
        .then(function (response) {
            $scope.mainTournaments = response.data;
        })

    $scope.tables = [];
    $scope.mainTable = 1;
    $scope.insertTournament = {name: '', tier: '', type: '', numberOfTeams: '', qualifier: '', start: '', end: ''};

    var match = {name: 'match', value: 0};
    var bracket = {name: 'bracket', value: 0};
    var matchResult = {name: 'matchResult', value: 0};
    var team = {name: 'team', value: 0};
    var tournament = {name: 'tournament', value: 0};
    var participants = {name: 'tournamentParticipants', value: 0};
    var group = {name: 'group', value: 0};
    var player = {name: 'player', value: 0};
    var news = {name: 'news', value: 0};
    var trophy = {name: 'trophy', value: 0};

    $scope.tables.push(match);
    $scope.tables.push(bracket);
    $scope.tables.push(matchResult);
    $scope.tables.push(team);
    $scope.tables.push(tournament);
    $scope.tables.push(participants);
    $scope.tables.push(group);
    $scope.tables.push(player);
    $scope.tables.push(news);
    $scope.tables.push(trophy);

    $scope.insert = function (table) {
        $scope.tables.forEach(tab => tab.value = 0);
        $scope.tables.find(tab => tab.name === table).value = 1;
        $scope.mainTable = 0;
    }
    $scope.toggleMain = function () {
        $scope.tables.forEach(tab => tab.value = 0);
        $scope.mainTable = 1;
    }


    //Insert
    $scope.insertTournamentFunction = function(){
        $scope.insertTournament.qualifier = document.getElementById('insertTournamentQualifier').value;
        $scope.insertTournament.type = document.getElementById('insertTournamentType').value;
        $http({
            url: BASE_URL + 'api/tournaments',
            method: 'POST',
            data: JSON.stringify($scope.insertTournament) ,
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            console.log(response);
        })
    }
});