(function(){
    'use strict';
    angular.module('providers')
        .factory('providersFactory',providersFactory);

    providersFactory.$inject = ['$q','baseFactory','$http'];

    function providersFactory($q,baseFactory,$http){
        return {
            getAllProviders : getAllProviders,
            postProvider : postProvider,
            putProvider : putProvider,
            deleteProvider: deleteProvider
        };

        function getAllProviders(){
            return $q(function (resolve, reject) {
                var url = 'proveedores.php';
                baseFactory(url).get().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function postProvider(data){
            return $q(function (resolve, reject) {
                var url = 'proveedores.php';
                baseFactory(url, data).post().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function putProvider(data){
            return $q(function (resolve, reject) {
                var url = 'proveedores.php?id_pro='+data.id_pro;
                baseFactory(url, data).put().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function deleteProvider(id){
            return $q(function (resolve, reject) {
                var url = 'proveedores.php?id_pro='+id;
                baseFactory(url).delete().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

    }
})();