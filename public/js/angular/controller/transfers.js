app.controller('transfers', function ($http, $scope, BASE_URL) {

    //Fetch teams for rank table
    $http.get(BASE_URL + 'api/transfers?limit=30')
        .then(function (response) {
            $scope.transfers = response.data;
            $scope.lead_transfer = response.data[0];
        })

});