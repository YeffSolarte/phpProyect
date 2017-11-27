(function(){
    'use strict';
    angular.module('ironSoftApp', [
        'ui.router',
        'ui.grid',
        'employees',
        'items',
        'providers',
        'clients',
        'inventory',
        'ui.grid.selection',
        'ui.grid.resizeColumns',
        'ui.grid.rowEdit',
        'ui.grid.cellNav',
        'ui.grid.pinning',
        'ui.grid.pagination',
        'ui.grid.grouping',
        'ui.grid.exporter',
        'purchase'
    ])
        .constant('ngAuthSettings',{apiServiceBaseUri: 'http://localhost/phpProyect/api/'});
})();