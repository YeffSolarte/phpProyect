(function(){
    'use strict';
    angular.module('items')
        .factory('itemsFactory',itemsFactory);

    itemsFactory.$inject = ['$q','baseFactory','$http'];

    function itemsFactory($q,baseFactory,$http){
        return {
            getAllItems : getAllItems,
            postItem : postItem,
            putItem : putItem,
            deleteItem: deleteItem
        };

        function getAllItems(){
            return $q(function (resolve, reject) {
                var url = 'articulos.php';
                baseFactory(url).get().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function postItem(data){
            return $q(function (resolve, reject) {
                var url = 'articulos.php';
                baseFactory(url, data).post().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function putItem(data){
            return $q(function (resolve, reject) {
                var url = 'articulos.php?id_art='+data.id_art;
                baseFactory(url, data).put().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

        function deleteItem(id){
            return $q(function (resolve, reject) {
                var url = 'articulos.php?id_art='+id;
                baseFactory(url).delete().then(function (response) {
                    resolve(response.data);
                }, function (reason) {
                    reject(reason);
                });
            });
        }

    }
})();