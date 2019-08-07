
//* Content View Definition *//
angular.module('contentView', ['ngRoute','ngSanitize']).config(function($routeProvider) {

	this.contentRouteProvider = {
		template   : 'elements/views/contentTemplate.html',
		controller : 'contentController'
	};

	$routeProvider
	.when('/', {
		templateUrl: this.contentRouteProvider.template,
		controller: this.contentRouteProvider.controller
	})
	.when('/:name', {
		templateUrl: this.contentRouteProvider.template,
		controller: this.contentRouteProvider.controller
	})

}).controller('contentController', ['$scope', '$location', '$http','$sce', function($scope, $location, $http, $sce) {
    $("#page-content").css("display","none");
    $("#loadingContent").css("display","block");
	$scope.content = [{pageTitle:"<span id='loadingHeader' class='loadingHeader'>Loading...</span>",
		pageContent:""}];

	$http.get('protected/Main.php?request='+$location.path().substring(1))
		.then(function(response){
				// ENABLE THIS ONCE CHROME KILLS JQUERY ASYNC
				//Get files
				// if(typeof response.data[0].files !== 'undefined') {
				// 	if((response.data[0].files).length > 0) {
				// 		var fileArr = [];
				// 		fileArr = stringToArray(response.data[0].files, ",");
				// 		for(var i = 0; i < fileArr.length; i++) {
				// 			$http.get(fileArr[i]);
				// 		}
				// 	}
				// }
				//Assign content

				$scope.content[0].pageTitle = $sce.trustAsHtml(response.data[0].pageTitle);
				$scope.content[0].pageContent = $sce.trustAsHtml(response.data[0].pageContent);

                $(document).ready(function() {
                    $("#page-content").fadeIn(800, function() {
                        document.responsiveJQuery.execOnResize();
                        $("#loadingContent").fadeOut(150);
                    });

                });



			}, function(response) {
				// Error handling
				$scope.content = [{pageTitle:"Page Not Found", pageContent:"Sorry :("}];
			}
		);
	}
]);
//end Content View defn

// Util functions

/* 
// WILL BE ENABLED ONCE CHROME KILLS JQUERY ASYNC
	Takes a string and returns an array of strings
*/
function stringToArray(string, delimiter) {
	var arr = [], i = 0, max=string.length;
	while(string.indexOf(delimiter) >= 0 && i<max) {
		arr[i] = string.substring(0,string.indexOf(delimiter));
		string = string.substring(string.indexOf(delimiter) + 1, string.length);
		i = i+1;
	}
	if(string.indexOf(delimiter) < 0 && string.length > 0) {
		arr[i] = string;
	}
	return arr;
}