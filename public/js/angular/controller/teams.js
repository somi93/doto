app.controller('teams', function ($http, $scope, BASE_URL) {

    //Fetch teams for rank table
    $http.get(BASE_URL + 'api/teams?active=1')
        .then(function (response) {
            $scope.teams = response.data;
            $scope.lead_team = response.data[0];
        })

    //Fetch regions
    $http.get(BASE_URL + 'api/regions')
        .then(function (response) {
            $scope.regions = response.data;
        })
});