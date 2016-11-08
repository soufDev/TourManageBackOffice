myApp.controller('realiserLivraisonController', function ($scope, $http, realiserLivraisonService, SERVICEURL) {

    // recuperer l'id de la commande et la mettre dans une variable global
    var idCommande = realiserLivraisonService.getData().idCommande;
    //recuperer les donnée necessaire
    $scope.init = function () {
        $http.get(SERVICEURL + '/realiserLivraisonLigneCommande/' +idCommande).success(function (data) {
            $scope.livraisons = data.livraison_infos[0];
            $scope.lignes_commandes = data.lignes_commandes;
            $scope.transporteurs = data.transporteurs;
            $scope.statuts = [
                {"id": "1", "value":"EN COURS"},
                {"id": "2", "value":"LIVREE"},
                {"id": "3", "value":"NON LIVREE"}
            ];
            $scope.motifNomLivraisons = [
                {"id":"1", "value":"MANQUE STOCK"},
                {"id":"2", "value":"LIVRAISON ANNULEE"},
                {"id":"3", "value":"PRODUIT MANQUANT"}
            ]
        })
    };

    // recuperer les données d'une ligne Commande
    $scope.edit = function (id) {
        $http.get(SERVICEURL +'/realiserLivraison/'+ id+'/edit').success(function(data){
            $scope.ligneCommande = data[0];
        });
    };
    
    // mettre a jour une ligne de commande
    $scope.update = function (ligneCommande) {
        $http.put(SERVICEURL+'/realiserLivraison/'+ ligneCommande.id, ligneCommande).success(function (data) {
            $scope.init();
            $("#myModal").modal('hide');
        })
    };


    $scope.init();
});