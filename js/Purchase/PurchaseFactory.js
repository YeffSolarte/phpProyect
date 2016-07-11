(function(){
    'use strict';
    angular.module('purchase')
        .factory('purchaseFactory',purchaseFactory);

    purchaseFactory.$inject = ['$q','baseFactory','$http'];

    function purchaseFactory($q,baseFactory,$http){
        return {
            getAllProviders : getAllProviders,
            getConsecutive : getConsecutive,
            postPurchase : postPurchase,
            putPurchase : putPurchase,
            deletePurchase: deletePurchase
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

        function getConsecutive(doc){
            return $q(function (resolve, reject) {
                var url = 'consecutivos.php?id_tip=' + doc;
                baseFactory(url).get().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function postPurchase(data){
            return $q(function (resolve, reject) {
                var url = 'compras.php';
                baseFactory(url, data).post().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function putPurchase(data){
            return $q(function (resolve, reject) {
                var url = 'proveedores.php?id_pro='+data.id_pro;
                baseFactory(url, data).put().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function deletePurchase(id){
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