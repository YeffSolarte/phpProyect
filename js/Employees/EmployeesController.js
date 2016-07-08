(function(){
    'use strict';
    angular.module('employees')
        .controller('EmployeesController',EmployeesController);

    EmployeesController.$inject = ['$scope'];

    function EmployeesController($scope){
        var vm = this;
        vm.saludo = 'whatsaaaaaaap';
    }
})();