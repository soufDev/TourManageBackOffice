myApp.controller('compteController', function($scope, $http, SERVICEURL ) {

    // recuperer les données
    $scope.init = function(){
        $http.get(SERVICEURL+'/listeCompte').success(function (data) {
            $scope.comptes = data;
        })
    }

    // afficher les donnée a modifier
    // on utilise la requet get
    $scope.edit = function (id) {

        $http.get(SERVICEURL+'/comptes/'+id+'/edit').success( function(data) {
            console.log( data[0] );
            $scope.compte=data[0];
        })
    };

    // mettre a jour un compte
    // on utilise la requet put
    $scope.update = function( compte ) {
        $http.put(SERVICEURL + '/comptes/'+ compte.id + '', compte)
            .success(function (data) {
                $scope.init();
                $('#edit-modal').modal('hide');

            })
    };

    // supprimer un compte
    $scope.delete = function (id) {
        if( confirm("Etes-Vous sûr ?") ) {
            $http.delete(SERVICEURL+'/comptes/'+id+'')
                .success(function (data) {
                    $scope.init();

                })
        }
    };


    $scope.init();
});