myApp.controller('loginController' , function ($scope, $http, SERVICEURL) {

    doLogin = function (data) {
        console.log(data.login);
    }
});