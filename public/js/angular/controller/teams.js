app.controller('teams', function ($http, $scope, BASE_URL) {

    //Fetch teams for rank table
    $http.get(BASE_URL + 'api/teams?active=1')
        .then(function (response) {
            $scope.teams = response.data;
            $scope.changeLeadTeam(response.data[0]);
        })

    //Fetch regions
    $http.get(BASE_URL + 'api/regions')
        .then(function (response) {
            $scope.regions = response.data;
        })

    $scope.changeLeadTeam = function (team) {
        $http.get(BASE_URL + 'api/teams?id=' + team.id)
            .then(function (response) {
                $scope.leadTeam = response.data[0];
            })

        //Fetch lead team matches
        $http.get(BASE_URL + 'api/matches?team=' + team.id)
            .then(function (leadTeam) {
                $scope.leadTeamMatches = leadTeam.data;
                $scope.leadTeamMatches.forEach(function(match) {
                    match.start_time = moment(match.start_time).format('D MMM');
                });
            })
    }

});