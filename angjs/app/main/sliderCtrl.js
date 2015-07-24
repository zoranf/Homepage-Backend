kmtApp.controller("sliderCtrl", ["$scope", "sliderService", function($scope, sliderService){
    // sliderCtrl controller
    $scope.sliderList = [];

    sliderService.getAssets(function(result) {
        $scope.sliderList = result.data;
    });

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        $(".asset-slider").bxSlider({
            mode: 'fade',
            captions: true,
            buildPager: function(index) {
                return '<div class="current' + index + ' button"></div>';
            },
            nextText: '<div class="nextText"></div>',
            prevText: '<div class="previousText"></div>'
        });
    });
}]);
