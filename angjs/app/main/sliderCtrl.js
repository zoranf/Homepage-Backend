app.controller("sliderCtrl", ["$scope", "sliderService", function($scope, sliderService, $location) {
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

// Scroll to section
app.controller('scrollCtrl', function($scope, $location) {
    $scope.scrollTo = function(id) {
        $location.hash(id);
        smoothScroll(id);
    };

    function smoothScroll(eID) {
        var startY = currentYPosition();
        var height = 84;
        var stopY = elmYPosition(eID) - height;
        var distance = stopY > startY ? stopY - startY : startY - stopY;
        if (distance < 100) {
            scrollTo(0, stopY); return;
        }
        var speed = Math.round(distance / 100);
        if (speed >= 20) speed = 20;
        var step = Math.round(distance / 25);
        var leapY = stopY > startY ? startY + step : startY - step;
        var timer = 0;
        if (startY === 0) stopY = stopY - height;
        if (stopY > startY) {
            for ( var i=startY; i<stopY; i+=step ) {
                setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
                leapY += step; if (leapY > stopY) leapY = stopY; timer++;
            } return;
        }
        for ( var i=startY; i>stopY; i-=step ) {
            setTimeout("window.scrollTo(0, "+leapY+")", timer * speed);
            leapY -= step; if (leapY < stopY) leapY = stopY; timer++;
        }
    }

    function elmYPosition(id) {
        var elm = document.getElementById(id);
        var y = elm.offsetTop;
        var node = elm;
        while (node.offsetParent && node.offsetParent != document.body) {
            node = node.offsetParent;
            y += node.offsetTop;
        } return y;
    }

    function currentYPosition() {
        // Firefox, Chrome, Opera, Safari
        if (self.pageYOffset) return self.pageYOffset;
        // Internet Explorer 6 - standards mode
        if (document.documentElement && document.documentElement.scrollTop)
            return document.documentElement.scrollTop;
        // Internet Explorer 6, 7 and 8
        if (document.body.scrollTop) return document.body.scrollTop;
        return 0;
    }
});
