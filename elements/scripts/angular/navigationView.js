//* Navigation View Definition *//
var navigationView = angular.module('navigationView', ['ngSanitize'])

navigationView.controller ('navigationController', ['$scope','$http','$location','$anchorScroll', function($scope, $http, $location, $anchorScroll) {

	// Load Nav Items
	$scope.navigationItems = [];
	$http.get('protected/Main.php?request=Navigation')
		.then(function(response){
			$scope.navigationItems = response.data;                
		}, function(response) {
			// Error handling
			$scope.navigationItems = [{navTitle:"Navigation Not Found", navLink:"#"}];
		}
	);

	$scope.gotoNavigationTop = function() {
		if (document.applicationVariables.navTop <= $(document).scrollTop()) {
            $anchorScroll('scrolledTop');
		}
	};

}]);
