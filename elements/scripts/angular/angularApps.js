// Declare any new angular apps here, assign it with the div id
angular.element(document).ready(function() {
    angular.bootstrap($("#navigationWrap"), ['navigationView']);
    angular.bootstrap($("#content"), ['contentView']);
});

