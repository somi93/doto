app.controller('player', function ($http, $scope, BASE_URL) {

    var url = document.documentURI;
    var id = url.split('/')[4];

    //Fetch team
    $http.get(BASE_URL + 'api/players?id=' + id)
        .then(function (response) {
            $scope.player = response.data[0];
            $scope.player.team_history.forEach(function(team) {
                team.start = moment(team.start).format('D MMM YYYY');
                if(team.end != 'Present') team.end = moment(team.end).format('D MMM YYYY');
            });
            $scope.player.trophies.forEach(function(trophy) {
                trophy.date = moment(trophy.date).format('D MMM YYYY');
            });
        })


});