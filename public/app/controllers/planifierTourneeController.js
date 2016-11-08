myApp.controller('planifierTourneeController', function ($scope, $filter, $http, SERVICEURL) {
    
    $scope.init = function () {
        $http.get(SERVICEURL+'/tourneesData').success( function (data) {
            $scope.transporteurs = data.transporteurs;
            $scope.etapes = data.etapes;
            $scope.stockTournees = data.stockTournees;
            console.log(data.livraisons);
            $scope.livraisons = data.livraisons;
        })
    };

    $scope.getData = function(DataTournee) {
        if(DataTournee.dateTournee == undefined && DataTournee.transporteur == undefined){
            $scope.etapes = undefined;
            $scope.stockTournees = undefined;
            $scope.livraisons = undefined;
            console.log('selectionner une date et un Agent');
        } else if(DataTournee.dateTournee == undefined && DataTournee.transporteur != undefined){
            $http.post(SERVICEURL+'/tourneesDataTransporteur', DataTournee).success(function (data) {
                console.log(data);
                $scope.etapes = data.etapes;
                $scope.stockTournees = data.stockTournees;
                $scope.livraisons = data.livraisons;

            }).error(function () {
                console.log('Error transporteur');
            })
        }else if(DataTournee.dateTournee != undefined && DataTournee.transporteur == undefined){
            $http.post(SERVICEURL+'/tourneesDataDate', DataTournee).success(function (data) {
                console.log(data);
                $scope.etapes = data.etapes;
                $scope.stockTournees = data.stockTournees;
                $scope.livraisons = data.livraisons;
            }).error(function () {
                console.log('Error date');
            })
        }else {
            $http.post(SERVICEURL+'/donneesTournees', DataTournee).success(function (data) {
                console.log(data);
                $scope.etapes = data.etapes;
                $scope.stockTournees = data.stockTournees;
                $scope.livraisons = data.livraisons;
            }).error(function () {
                console.log('Error date & transporteur');
            })
        }
    };


    $scope.edit = function(idStock) {
        $scope.stockTournee = $filter('filter')($scope.stockTournees, {id:idStock}) [0];
        console.log($scope.stockTournee);
    };

    $scope.editstock = function (stockTournee, tournee, quantite) {
        if( !isNaN( quantite) ){
            $http.put(SERVICEURL+'/planifierTournees/'+stockTournee.id, stockTournee)
                .success( function (data) {
                    console.log(data);
                    $scope.getData(tournee);
                    $("#editStock").modal('hide');
                })
                .error( function (data) {
                    console.log(data);
                });
        }else{
            alert('Veuillez Tapez Un Nombre');
        }
    };

    $scope.update = function(stockInitial) {
        console.log( isNaN( stockInitial ) + " - " + stockInitial);
    };
    $scope.init();
});