kmtApp.factory("sliderService", function($http, $location) {
    return {
        getAssets: function(successCallback){
            sendRequest(
                "Asset/get",
                {},
                "GET",
                function(result){
                    successCallback(result);
                },
                $http,
                $location
            );
        }
    };
});
