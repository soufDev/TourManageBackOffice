myApp.controller('livraisonController', function($scope, $http, preparerServiceLivraison, realiserLivraisonService, SERVICEURL) {


    // recuperer les données
    $scope.init = function () {
        $http.get(SERVICEURL+'/listeLivraison').success(function (data) {
            $scope.livraison_infos = data.livraison_infos;
            $scope.transporteurs = data.transporteurs;
            $scope.clients = data.clients;
        })
    };

    // pour activer ou disacitver la modifiation
    $scope.ecrire = false;
    
    // afficher les données dans la pop up
    $scope.edit = function (id) {
        $http.get(SERVICEURL+'/livraisons/'+id+'/edit').success(function (data) {
            $scope.ecrire= false;
            $scope.livraisons = data.livraison_infos[0];
            $scope.lignes_commandes = data.lignes_commandes;
            console.log( $scope.livraisons );

        })
    };

    // fonction pour aller a la page 'preparerLivraison' avec un parametre
    $scope.goToPreparerLivraison = function (id) {
        preparerServiceLivraison.clearData();
        $http.get(SERVICEURL+'/livraisons/'+id+'/edit').success(function (data) {
            $scope.livraisons = data.livraison_infos[0];
            preparerServiceLivraison.addData( $scope.livraisons );
            window.location.href = "preparerLivraison";
        });
    };


    // fonction pour aller a la page 'realiserLivraison' avec un parametre
    $scope.goToRealiserLivraison = function (id) {
        realiserLivraisonService.clearData();
        $http.get(SERVICEURL + '/livraisons/'+id+'/edit').success(function (data) {
            $scope.livraisons = data.livraison_infos[0];
            realiserLivraisonService.addData( $scope.livraisons );
            window.location.href = "realiserLivraison";
        })
    };

    
    $scope.update = function () {
        
    };

    $scope.init();
} );