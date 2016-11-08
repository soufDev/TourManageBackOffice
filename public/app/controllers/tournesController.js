myApp.controller('tournesController', function($scope, $http, SERVICEURL){

    $scope.init = function() {
        $http.get(SERVICEURL+'/listeTournees').success( function (data) {
            $scope.tournees = data.tournees;
            $scope.vehicules = data.vehicules;
            $scope.transporteurs = data.transporteurs;
            $scope.statuts = [
                {"id": "1", "value":"EN COURS"},
                {"id": "2", "value":"TERMINEE"},
                {"id": "3", "value":"ANNULEE"}
            ];

        });
    };

    $scope.affecter = function(tournee) {
        console.log(tournee);
        $http.post(SERVICEURL+'/tournes', tournee)

            .success(function (data) {
                console.log(data);
                $scope.init();
                $('#attribuerVehicule').modal('hide');
            })

            .error(function(data){
                $scope.init();
                console.log('Error');
                console.log(data);
                alert("une erreur s'est produite lors de la génération de tournée");
            })
    };

    $scope.edit = function (idTournee) {
        $http.get(SERVICEURL+'/tournes/'+idTournee+'/edit')
            .success( function (data) {

                $scope.init();
        }).error( function (data) {

        });
    };

    $scope.update = function (tournee) {
        $http.put(SERVICEURL+'/tournes/'+tournee.id+'', tournee)
            .success( function (data) {

                $scope.init();
            }).error( function (data) {

        });
    };

    $scope.delete = function (idTournee) {
        if( confirm("Etes-vous sûr ?") ){
            $http.delete(SERVICEURL+'/tournes/'+idTournee+'/edit')
                .success( function (data) {

                    $scope.init();
                }).error( function (data) {

            });
        }
    };

    $scope.init();
} );