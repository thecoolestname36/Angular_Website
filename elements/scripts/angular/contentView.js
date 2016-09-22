//* Content View Definition *//
var contentView = angular.module('contentView', ['ngRoute','ngSanitize']);
contentView.config(function($routeProvider) {

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
	$scope.content ="<span class=\"loadingHeader\">Loading...</span>" +
					"<span class=\"loadingContent\"><i class=\"fa fa-cog fa-spin bigCog\">" +
					"</i><i class=\"fa fa-cog fa-spin topCog\"></i><i class=\"fa fa-cog fa-spin " +
					"bottomCog\"></i></span>";
	var getFile = false;

	$http.get('website-data/content/page-' + $location.path().substring(1) + '.content') 
		.then(function(response){

			console.log("Uncomment $http.get() in contentView.js once google kills \"Synchronous XMLHttpRequest\"");
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
			//$scope.content[0].pageTitle = $sce.trustAsHtml(response.data[0].pageTitle);
			//$scope.content[0].pageContent = $sce.trustAsHtml(response.data[0].pageContent);
			$scope.content = $sce.trustAsHtml(response.data);
		}, function(response) {
			// Error handling
			$scope.content = $sce.trustAsHtml("<h2>Page Not Found</h2><p>Sorry :(</p>");
		}
	);
}]);
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