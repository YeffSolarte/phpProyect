<?php 
	require("webApi/conection_db.php");
?>
<!DOCTYPE html>
<html ng-app="ironSoftApp">
	<head>
		<title>IRON SOFT</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body ng-controller="MainController as mCtrl">
        <div ui-view></div>
        {{mCtrl.saludo}}
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.3.1/angular-ui-router.js"></script>
        <script src="js/IronSoftApp.js"></script>
        <script src="js/MainController.js"></script>
        <script src="js/routeStates.js"></script>
	</body>
</html>