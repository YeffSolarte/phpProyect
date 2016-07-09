(function(){
    'use strict';
    angular.module('inventory')
        .config(inventoryConfig);

    inventoryConfig.$inject = ['$stateProvider'];

    function inventoryConfig($stateProvider){
        $stateProvider
            .state('home.inventory', {
                url: "/inventory",
                templateUrl: 'js/Inventory/InventoryView.html',
                controller: 'InventoryController',
                controllerAs: "inCtrl"
            });
    }
})();