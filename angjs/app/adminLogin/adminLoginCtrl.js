app.controller("adminLoginCtrl", ["$scope", "$http", "$location", "loginService", function($scope, $http, $location, loginService) {

    $scope.message = {
        error: ""
    };

    $scope.login = function() {
        loginService.authenticate(function(result) {
            if (result.success === true) {
               $location.url("/admin");
            } else {
                $scope.message.error = "Napačni podatki (tu more iti iz codeignitera msg)";
            }
        }, $scope.user.username, $scope.user.password);
    }
}]);
