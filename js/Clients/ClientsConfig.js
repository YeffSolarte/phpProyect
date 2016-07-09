(function(){
    'use strict';
    angular.module('clients')
        .config(clientsConfig);

    clientsConfig.$inject = ['$stateProvider'];

    function clientsConfig($stateProvider){
        $stateProvider
            .state('home.clients', {
                url: "/clients",
                templateUrl: 'js/Clients/ClientsView.html',
                controller: 'ClientsController',
                controllerAs: "clCtrl"
            });
    }
})();