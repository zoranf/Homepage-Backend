app.factory("loginService", function($http, $location) {
    return {
        authenticate: function(successCallback, username, password){
            var status = false;
            sendRequest(
                "User/authenticate",
                {
                    username: username,
                    password: password
                },
                "POST",
                function(result) {
                    successCallback(result);
                },
                $http,
                $location
            );
        }
    };
});
