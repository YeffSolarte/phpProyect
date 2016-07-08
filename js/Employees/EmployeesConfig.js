(function(){
    'use strict';
    angular.module('employees')
        .config(employeesConfig);

    employeesConfig.$inject = ['$stateProvider'];

    function employeesConfig($stateProvider){
        $stateProvider
            .state('home.employees', {
                url: "/employees",
                templateUrl: 'js/Employees/EmployeesView.html',
                controller: 'EmployeesController',
                controllerAs: "emCtrl"
            });
    }
})();