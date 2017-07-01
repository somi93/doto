app.controller('match', function ($http, $scope, BASE_URL) {

    var url = document.documentURI;
    var id = url.split('/')[4];

    //Fetch team
    $http.get(BASE_URL + 'api/matches?id=' + id)
        .then(function (response) {
            $scope.match = response.data[0];
            $scope.match.tournament.forEach(function(tour) {
                tour.start = moment(tour.start).format('D MMM YYYY, H:mm');
            });
            $scope.match.team1wins = 0;
            $scope.match.team2wins = 0;
            $scope.match.draws = 0;
            $scope.match.encounters.forEach(function(encounter) {
                encounter.start_time = moment(encounter.start_time).format('D MMM YYYY');
                if(encounter.team1.score > encounter.team2.score){
                    $scope.match.team1wins++;
                } else if(encounter.team1.score < encounter.team2.score){
                    $scope.match.team2wins++;
                } else{
                    $scope.match.draws++;
                }
            });
        })


});