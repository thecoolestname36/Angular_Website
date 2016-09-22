<!doctype HTML>

<html lang="en-US">

		<head>

		<!-- HTML Definitions -->

		<title>Brad's Website</title>
		<meta charset="UTF-8">
		<meta name="description" content="Brad's Website">
		<meta name="keywords" content="HTML,CSS,ASPX,JavaScript">
		<meta name="author" content="Bradley Cutshall">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="elements/images/facicon.png" />

		<!-- Stylesheets -->

		<link rel="stylesheet" type="text/css" href="elements/styles/css/main.css">

		<!-- Package stylesheets -->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<!-- Fonts -->
		
		<link href='//fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>

		<!-- Include packages below -->

		<script type="text/javascript" src="packages/js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="packages/js/angular.min.js"></script>
		<script tyle="text/javascript" src="packages/js/angular-route.min.js"></script>
		<script tyle="text/javascript" src="packages/js/angular-sanitize.min.js"></script>

		<!-- Custom Scripts -->

		<!-- JScript --> 
		<script type="text/javascript" src="elements/scripts/javascript/scripts.js"></script>
		<!-- Jquery -->
		<script type="text/javascript" src="elements/scripts/jquery/variablesJQuery.js"></script>
		<script type="text/javascript" src="elements/scripts/jquery/responsiveJQuery.js"></script>
		<script type="text/javascript" src="elements/scripts/jquery/mainJQuery.js"></script>
		<!-- AngularJs -->
		<script type="text/javascript" src="elements/scripts/angular/angularApps.js"></script>
		<!-- Angular Apps -->
		<script type="text/javascript" src="elements/scripts/angular/navigationView.js"></script>
		<script type="text/javascript" src="elements/scripts/angular/contentView.js"></script>
		

	</head>
	<body>
		<!-- Place things to preload here -->
		<div id="preloader">
			<i class="fa fa-cog fa-spin"></i>
		</div>
		<div id="headerBg"></div>
		<div id="pageWrap">

			<div id="header">
				<div id="headings">
					<span class="logo"><a href="/~cutsh020">Bradley Cutshall</a></span>
				</div>
			</div>

			<div id="navigationWrap" ng-controller="navigationController">
				<ul id="navBar">
					<li class="navItem" ng-repeat="_navItem in navigationItems" size-after-repeat>
						<a class="navLink" href="{{_navItem.navLink}}" ng-click="gotoNavigationTop()">{{_navItem.navTitle}}</a>
					</li>
				</ul>
			</div>

			<div id="body">
				<!-- <div id="leftPanel">
					
				</div> -->
				
				<div id="content" ng-controller="contentController">
					<div ng-view></div>
				</div>

				<div id="rightPanel">
					<div id="contactbox">
						<h3>
							Contact Me<br>
						</h3>
						<hr>
						<p>Phone</p>
							<h5><a href="tel:+16512456643">(651) 245-6643</a></h5>
						<p>E-mail</p>
							<h5><a href="mailto:cutsh020@d.umn.edu">cutsh020@d.umn.edu</li></h5>
							<h5><a href="mailto:brad.cutshall@gmail.com">brad.cutshall@gmail.com</li><h5>
					</div> 
				</div>
			</div>
			
			<!-- <div id="footer">
				<span class="content">Footer</span>
			</div> -->
		
		</div>
	</body>
</html>