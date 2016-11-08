myApp.controller('preparerLivraisonController', function ($scope, $http, preparerServiceLivraison, SERVICEURL) {


    // recuperer l'id Commande, l'id livraison
    var idCommande = preparerServiceLivraison.getData().idCommande;

    $scope.statuts = [
        {"id": "1", "value":"EN COURS"},
        {"id": "2", "value":"LIVREE"},
        {"id": "3", "value":"NON LIVREE"}
    ];
    // recuperer les doonées dont on a besoin
    $scope.init = function () {
        $http.get(SERVICEURL+'/ligneCommandeLivraison/'+idCommande).success(function(data){
            $scope.livraisons = data.livraison_infos[0];
            $scope.lignes_commandes = data.lignes_commandes;
            $scope.transporteurs = data.transporteurs;
            
        });

    };

    // recuperer les donnée de la ligne selectionnée
    $scope.edit = function (id) {
        $http.get(SERVICEURL+'/preparerLivraison/'+id+'/edit').success(function (data) {
            console.log( data[0] );
            $scope.ligneCommande = data[0];
        });
    };

    // modifier les données de la ligne selectionnée
    $scope.update = function(ligneCommande){
        $http.put(SERVICEURL + '/preparerLivraison/' +ligneCommande.id, ligneCommande)
            .success( function(data){
                $scope.init();
                $("#myModal").modal('hide');
            } );
    };

    // supprimer une ligne de commande
    $scope.delete = function (id) {
        if( confirm("Etes-Vous sûr ?") ) {
            $http.delete(SERVICEURL + '/preparerLivraison/' + id)
                .success(function (data) {
                    $scope.init();
                })
        }
    };

    // valider et envoyer les données vers a l'etape livraison
    $scope.valider  = function(){
        $http.get(SERVICEURL+'/livraisonsToEtapesTournes/'+idCommande)
            .success(function(data){
                console.log( data );
            });
    };
    $scope.init();
    
});