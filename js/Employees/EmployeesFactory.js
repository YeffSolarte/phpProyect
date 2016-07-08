(function(){
    'use strict';
    angular.module('employees')
        .factory('employeesFactory',employeesFactory);

    employeesFactory.$inject = [];

    function employeesFactory(){
        return {};
    }
})();