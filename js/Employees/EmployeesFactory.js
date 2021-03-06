(function(){
    'use strict';
    angular.module('employees')
        .factory('employeesFactory',employeesFactory);

    employeesFactory.$inject = ['$q','baseFactory','$http'];

    function employeesFactory($q,baseFactory,$http){
        return {
            getAllEmployees : getAllEmployees,
            postEmployee : postEmployee,
            putEmployee : putEmployee,
            deleteEmployee: deleteEmployee
        };

        function getAllEmployees(){
            return $q(function (resolve, reject) {
                var url = 'empleados.php';
                baseFactory(url).get().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function postEmployee(data){
            return $q(function (resolve, reject) {
                var url = 'empleados.php';
                baseFactory(url, data).post().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function putEmployee(data){
            return $q(function (resolve, reject) {
                var url = 'empleados.php?id_emp='+data.id_emp;
                baseFactory(url, data).put().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function deleteEmployee(id){
            return $q(function (resolve, reject) {
                var url = 'empleados.php?id_emp='+id;
                baseFactory(url).delete().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

    }
})();