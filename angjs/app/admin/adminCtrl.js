kmtApp.controller("adminCtrl", ["$scope", "$http", "$location", "assetService", function($scope, $http, $location, assetService) {

    $scope.assetList = [];

    $scope.toggleEnabled = function(asset) {
        var enabled;
        if (asset.enabled === "1") {
            // disable
            enabled = "0";
        } else if (asset.enabled === "0") {
            // enable
            enabled = "1";
        }
        assetService.enableAsset(asset, enabled, function(result) {
            // assign enabled or disabled asset
            asset.enabled = enabled;
        });
    };

    $scope.go = function(path){
        $location.path(path);
    };

    assetService.getAssets(function(result) {
        $scope.assetList = result.data;
    });
}]);
