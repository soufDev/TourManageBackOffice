var myApp = angular.module('myApp',['ngResource', 'datatables', 'ui.bootstrap', 'dialogs.main','pascalprecht.translate'])
        .constant('SERVICEURL', 'http://eurequat-algerie.com/test/vente_embarque/');

myApp.service('monService', function () {
    var savedData = {
    };

    function set(data) {
        savedData = data;
    }
    function get() {
        return savedData;
    }

    return {
        set : set,
        get : get
    }
});

// service pour les livraisons

myApp.service('preparerServiceLivraison', function ($window) {
    var KEY = 'App.livraisonSelectedValue';

    var addData = function (newObj) {
        var mydata = $window.sessionStorage.getItem(KEY);
        if(mydata){
            mydata = JSON.parse(mydata);
        }else {
            mydata = [];
        }
        mydata = newObj;
        $window.sessionStorage.setItem(KEY, JSON.stringify(mydata));

    };

    var getData = function () {
        var mydata = $window.sessionStorage.getItem(KEY);
        if(mydata){
            mydata = JSON.parse(mydata);
        }

        return mydata || [];
    };

    var clearData = function () {
        var mydata = $window.sessionStorage.getItem(KEY);
        mydata = JSON.parse(null);
    };

    return {
        addData : addData,
        getData : getData,
        clearData : clearData
    }

});

// Service pour les ligne commande
myApp.service('realiserLivraisonService', function ($window) {
    var KEY = 'App.preparerLivraisonSelectedValue';
    
    var addData = function (newObj) {
        var mydata = $window.sessionStorage.getItem(KEY);
        if(mydata){
            mydata = JSON.parse(mydata);
        }else {
            mydata = [];
        }
        mydata = newObj;

        $window.sessionStorage.setItem(KEY, JSON.stringify(mydata));

    };

    var getData = function () {
        var mydata = $window.sessionStorage.getItem(KEY);
        if(mydata){
            mydata = JSON.parse(mydata);
        }

        return mydata || [];
    };

    var clearData = function () {
        var mydata = $window.sessionStorage.getItem(KEY);
        mydata = JSON.parse(null);
    };

    return {
        addData : addData,
        getData : getData,
        clearData : clearData
    }

});




