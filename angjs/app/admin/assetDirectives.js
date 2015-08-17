app.directive('backgrImg', function(){
    return function(scope, element, attrs){
        attrs.$observe('backgrImg', function(value) {
            var url = BACKEND_IP + "/upload/" + value;
            element.css({
                'background-image': 'url(' + url +')'
            });
        });
    };
});