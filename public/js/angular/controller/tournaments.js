app.controller('tournaments', function ($http, $scope, BASE_URL) {

    //Fetch teams for rank table
    $http.get(BASE_URL + 'api/tournaments?main=true')
        .then(function (response) {
            $scope.tournaments = response.data;
        })

});