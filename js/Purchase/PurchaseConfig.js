(function(){
    'use strict';
    angular.module('purchase')
        .config(purchaseConfig);

    purchaseConfig.$inject = ['$stateProvider'];

    function purchaseConfig($stateProvider){
        $stateProvider
            .state('home.purchase', {
                url: "/purchase",
                templateUrl: 'js/Purchase/PurchaseView.html',
                controller: 'PurchaseController',
                controllerAs: "psCtrl"
            });
    }
})();