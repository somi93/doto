app.controller('team', function ($http, $scope, BASE_URL) {

    var url = document.documentURI;
    var id = url.split('/')[4];

    //Fetch team
    $http.get(BASE_URL + 'api/teams?id=' + id)
        .then(function (response) {
            $scope.team = response.data[0];
            $scope.team.trophies.forEach(function(trophy) {
                trophy.date = moment(trophy.date).format('D MMM Y');
            });
        })

    $http.get(BASE_URL + 'api/matches?limit=20&team=' + id)
        .then(function (leadTeam) {
            $scope.matches = leadTeam.data;
            $scope.matches.forEach(function(match) {
                match.start_time = moment(match.start_time).format('D MMM');
            });
        })

});