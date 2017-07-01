app.controller('admin', function ($http, $scope, BASE_URL) {

    //Fetch data
    $http.get(BASE_URL + 'api/tournaments?main=true')
        .then(function (response) {
            $scope.mainTournaments = response.data;
        });

    $http.get(BASE_URL + 'api/teams?active=1')
        .then(function (response) {
            $scope.activeTeams = response.data;
        });

    $scope.tables = [];
    $scope.mainTable = 1;
    $scope.newParticipants = [];
    $scope.insertTournament = {name: '', tier: '', type: '', numberOfTeams: '', qualifier: '', start: '', end: ''};
    $scope.group = {group: '', tournament: '',team: ''};
    $scope.trophy = {position: '', tournament: '',team: ''};

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
        $scope.newParticipants = [];
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
            window.location.reload();
        })
    }

    $scope.insertTournamentParticipantsFunction = function(){
        var teams = [];
        for(var i = 0; i < $scope.newParticipants.length; i++){
            var id = document.getElementById('newParticipant' + i).value;
            if(id !== ''){teams.push(id);}
        }
        var tournamentId = document.getElementById('tournamentParticipantsId').value;
        var data = {id: tournamentId, teams: teams};
        $http({
            url: BASE_URL + 'api/tournamentParticipants',
            method: 'POST',
            data: JSON.stringify(data) ,
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            window.location.reload();
        })
    }

    $scope.insertGroup = function(){
        $scope.group.team = document.getElementById('tournamentGroupTeamId').value;
        $scope.group.tournament = document.getElementById('tournamentGroupTournamentId').value;
        $http({
            url: BASE_URL + 'api/group',
            method: 'POST',
            data: JSON.stringify($scope.group) ,
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            alert(response.data);
        })
    }

    $scope.insertTrophy = function(){
        $scope.trophy.team = document.getElementById('tournamentTrophyTeamId').value;
        $scope.trophy.tournament = document.getElementById('tournamentTrophyTournamentId').value;
        $http({
            url: BASE_URL + 'api/trophy',
            method: 'POST',
            data: JSON.stringify($scope.trophy) ,
            headers: {'Content-Type': 'application/json'}
        }).then(function (response) {
            alert(response.data);
        })
    }

    //Functions
    $scope.tournamentParticipants = function(tournament){
        $http.get(BASE_URL + 'api/tournaments/participants?id=' + tournament.id)
            .then(function (response) {
                $scope.participants = response.data;
                $scope.newParticipants = [];
                var restTeams = tournament.number_of_participants - $scope.participants.length;
                for(var i = 0; i < restTeams; i++){
                    $scope.newParticipants.push(i);
                }
            })
    }

    $scope.tournamentGroup = function(tournament){
        $http.get(BASE_URL + 'api/tournaments/participants?id=' + tournament.id)
            .then(function (response) {
                $scope.groupParticipants = response.data;
            })
    }

    $scope.tournamentTrophy = function(tournament){
        $http.get(BASE_URL + 'api/tournaments/participants?id=' + tournament.id)
            .then(function (response) {
                $scope.trophyParticipants = response.data;
            })
    }
});