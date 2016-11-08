myApp.controller('employeesController', function($scope, $http, $filter, SERVICEURL) {

    // pour apporter toutes les données
    $scope.init = function(){
        $http.get(SERVICEURL + '/listeAgent').success( function(data) {
            $scope.employes = data.employes;
            $scope.profils = data.profils;
            $scope.secteurs = data.secteurs;
        })
    };

    // pour creer un Employee
    // requet POST
    $scope.create = function (employe) {
        $http.post(SERVICEURL + '/employes', employe)
            .success( function(data) {
                console.log( employe );
                $scope.init();
                employe = null;
                $('#add-modal').modal('hide');

            }).error( function (data) {
                alert("Veuillez saisir un email et/ou identifiant different");
            });
    };

    // ici on fait voir les valeur a modifier
    // requet GET au employes/{id}/edit
    $scope.edit = function (id) {
        //$scope.employe = $filter('filter')($scope.employes, {id:id} )[0];
        //console.log( $filter('filter')($scope.employes, {id:id})[0] );

        $http.get(SERVICEURL+'/employes/' + id + '/edit')
            .success( function(data) {
            console.log( data[0] );
            $scope.employe = data[0];
        })
        
    };


    // mettre a jour les données dun employe donné
    // requet PUT au employes/id
    $scope.update = function (employe) {
        $http.put(SERVICEURL + '/employes/' + employe.id + '', employe)
            .success( function(data) {
                console.log(employe.datenaissance);
                
                $scope.init();

                $("#edit-modal").modal('hide');

            })
    };

    //Avec la requet Supprimer employes/{id}
    $scope.delete = function (id) {
        if ( confirm("Etes-Vous Sûr ? ")) {
            $http.delete(SERVICEURL + '/employes/' + id + '')
                .success(function (data) {
                    $scope.init();
                })
        }
    };

    $scope.init();


} );