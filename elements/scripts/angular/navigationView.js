//* Navigation View Definition *//
var navigationView = angular.module('navigationView', ['ngSanitize'])
// .directive("sizeAfterRepeat", function () {
// 	return function(scope) {
// 		if (scope.$last){
// 			console.log("Nav link not filling wrapper area.");
// 			//$("#navigationWrap").height($("#navBar").height());
// 		}
// 	};
// });
navigationView.controller ('navigationController', ['$scope','$http','$location','$anchorScroll', function($scope, $http, $location, $anchorScroll) {

	// Load Nav Items
	$scope.navigationItems = [];
	$http.get('website-data/navigation/nav-items.json') 
		.then(function(response){
			$scope.navigationItems = response.data;                
		}, function(response) {
			// Error handling
			$scope.navigationItems = [{navTitle:"Navigation Not Found", navLink:"#"}];
		}
	);

	$scope.gotoNavigationTop = function() {
		if (document.jQueryInitVars.navTop <= $(document).scrollTop()) {
			$anchorScroll('navigationWrap');
		}
	};

}]);
