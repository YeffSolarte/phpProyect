(function(){
    'use strict';
    angular.module('ironSoftApp')
        .controller('MainController', MainController);
    
    MainController.$inject = ['$scope'];
    
    function MainController($scope){
        $scope.saludo = "Que mas ve?";
        
        
    }
})();