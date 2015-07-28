app.factory("assetService", function($http, $location) {
    return {
        getAssets: function(successCallback){
            sendRequest(
                "AdminAsset/get",
                {},
                "GET",
                function(result){
                    successCallback(result);
                },
                $http,
                $location
            );
        },
        enableAsset: function(asset, enabled, successCallback){
            sendRequest(
                "AdminAsset/enable",
                {
                    id: asset.id,
                    enabled: enabled,
                },
                "PUT",
                function(result){
                    successCallback(result);
                },
                $http,
                $location
            );
        }
    };
});
