(function(){
    'use strict';
    angular.module('inventory')
        .factory('inventoryFactory',inventoryFactory);

    inventoryFactory.$inject = ['$q','baseFactory','$http'];

    function inventoryFactory($q,baseFactory,$http){
        return {
            /*getAllClients : getAllClients,
            postClient : postClient,
            putClient : putClient,
            deleteClient: deleteClient*/
        };

        /*function getAllClients(){
            return $q(function (resolve, reject) {
                var url = 'clientes.php';
                baseFactory(url).get().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function postClient(data){
            return $q(function (resolve, reject) {
                var url = 'clientes.php';
                baseFactory(url, data).post().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function putClient(data){
            return $q(function (resolve, reject) {
                var url = 'clientes.php?id_cli='+data.id_cli;
                baseFactory(url, data).put().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function deleteClient(id){
            return $q(function (resolve, reject) {
                var url = 'clientes.php?id_cli='+id;
                baseFactory(url).delete().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }*/

    }
})();