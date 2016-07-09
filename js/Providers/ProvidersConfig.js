(function(){
    'use strict';
    angular.module('providers')
        .config(providersConfig);

    providersConfig.$inject = ['$stateProvider'];

    function providersConfig($stateProvider){
        $stateProvider
            .state('home.providers', {
                url: "/providers",
                templateUrl: 'js/Providers/ProvidersView.html',
                controller: 'ProviderController',
                controllerAs: "prCtrl"
            });
    }
})();