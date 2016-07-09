(function(){
    'use strict';
    angular.module('ironSoftApp')
        .factory('baseFactory',baseFactory);

    baseFactory.$inject = ['$http','ngAuthSettings','$q'];

    function baseFactory ($http,ngAuthSettings,$q) {
        return function (apiUrl, data){
            console.log(apiUrl);
            return {
                get : function(){
                    return $q(function (resolve, reject) {
                        $http({
                            method: 'GET',
                            headers : {
                                'Content-Type': 'application/json'
                            },
                            url: ngAuthSettings.apiServiceBaseUri + apiUrl,
                            cache : false
                        }).then(function (response) {
                            resolve(response);
                        }, function (reason) {
                            reject(reason);
                        });
                    });
                },
                post : function(){
                    return $q(function (resolve, reject) {
                        $http({
                            method: 'POST',
                            url: ngAuthSettings.apiServiceBaseUri + apiUrl,
                            data : data,
                            headers : {
                                'Content-Type': 'application/json'
                            }
                        }).then(function (response) {
                            resolve(response);
                        }, function (reason) {
                            reject(reason);
                        });
                    });
                },
                put : function(){
                    return $q(function (resolve, reject) {
                        $http({
                            method: 'PUT',
                            url: ngAuthSettings.apiServiceBaseUri + apiUrl,
                            headers : {
                                'Content-Type': 'application/json'
                            },
                            data : data
                        }).then(function (response) {
                            resolve(response);
                        }, function (reason) {
                            reject(reason);
                        });
                    });
                },
                delete : function(){
                    return $q(function (resolve, reject) {
                        $http({
                            method: 'DELETE',
                            headers : {
                                'Content-Type': 'application/json'
                            },
                            url: ngAuthSettings.apiServiceBaseUri + apiUrl
                        }).then(function (response) {
                            resolve(response);
                        }, function (reason) {
                            reject(reason);
                        });
                    });
                }
            };
        };
    }
})();