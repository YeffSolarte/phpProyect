(function(){
    'use strict';
    angular.module('items')
        .config(itemsConfig);

    itemsConfig.$inject = ['$stateProvider'];

    function itemsConfig($stateProvider){
        $stateProvider
            .state('home.items', {
                url: "/items",
                templateUrl: 'js/Items/ItemsView.html',
                controller: 'ItemsController',
                controllerAs: "itCtrl"
            });
    }
})();