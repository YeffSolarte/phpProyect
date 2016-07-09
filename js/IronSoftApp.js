(function(){
    'use strict';
    angular.module('ironSoftApp', [
        'ui.router',
        'employees',
        'items',
        'providers',
        'clients',
        'inventory'
    ])
        .constant('ngAuthSettings',{apiServiceBaseUri: 'http://localhost:8080/phpProyect/api/'});
})();