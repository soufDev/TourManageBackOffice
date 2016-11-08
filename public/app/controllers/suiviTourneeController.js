myApp.controller('suiviTourneeController', function($scope, $filter, $http, SERVICEURL){
    $scope.init = function () {
        $http.get(SERVICEURL+'/beginData').success(function (data) {
            console.log(data);
            $scope.transporteurs = data.transporteurs;
        });
    };

    $scope.getData = function (DataTournee) {
        /*if(DataTournee.dateTournee == undefined && DataTournee.transporteur == undefined){
            $scope.etapes = undefined;
            $scope.stockTournees = undefined;
            $scope.livraisons = undefined;
            console.log('selectionner une date et un Agent');
        } else*/
        if(DataTournee.dateTournee == undefined && DataTournee.transporteur != undefined){
            $http.post(SERVICEURL+'/tourneesTranspoteur', DataTournee).success(function (data) {
                console.log(data);
                $scope.tournees = data;
            }).error(function () {
                console.log('Error transporteur');
            })
        }else if(DataTournee.dateTournee != undefined && DataTournee.transporteur == undefined){
            $http.post(SERVICEURL+'/tourneesDate', DataTournee).success(function (data) {
                console.log(data);

                $scope.tournees = data;
            }).error(function () {
                console.log('Error date');
            })
        }else {
            $http.post(SERVICEURL+'/tourneesData', DataTournee).success(function (data) {
                console.log(data);

                $scope.tournees = data;
            }).error(function () {
                console.log('Error date & transporteur');
            })
        }
    };

    $scope.init();
} );