(function(){
    'use strict';
    angular.module('ironSoftApp', [
        'ui.router',
        'employees',
        'items'
    ])
        .constant('ngAuthSettings',{apiServiceBaseUri: 'http://localhost:8080/phpProyect/api/'});
})();