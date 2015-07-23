// path constants
var BACKEND_IP = "http://eko.dev:8080/";
var BASE_PATH = "angjs/app/";

// application start
var kmtApp = angular.module("kmetijaApp", ["ngRoute"]);

kmtApp.config(function($routeProvider, $httpProvider) {
    // routes
    $routeProvider
        .when("/", {
            templateUrl: BASE_PATH + "main/_main.html",
            controller: "sliderCtrl"
        })
        .when("/admin", {
            templateUrl: BASE_PATH + "admin/_admin.html",
            controller: "adminCtrl"
        })
        .when("/admin-login", {
            templateUrl: BASE_PATH + "adminLogin/_admin-login.html",
            controller: "adminLoginCtrl"
        })
        .otherwise({
            redirectTo: "/"
        });

    // config for ajax requests
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.withCredentials = true;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
});
