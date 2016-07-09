(function(){
    'use strict';
    angular.module('clients')
        .controller('ClientsController',ClientsController);

    ClientsController.$inject = ['$scope','clientsFactory'];

    function ClientsController($scope,clientsFactory){
        var vm = this;
        vm.newClient = {
            tip_doc : 'CC'
        };
        vm.clients = [];
        vm.selectClient = selectClient;
        vm.submitClient = submitClient;
        vm.clearForm = clearForm;
        vm.getClientByDocNum = getClientByDocNum;
        vm.deleteClient = deleteClient;


        activate();
        function activate(){
            clientsFactory.getAllClients().then(function success(response){
                console.log(response);
                vm.clients = response;
            });
        }

        function getClientByDocNum(num){
            if(!vm.newClient.doc_cli) return;
            var result = vm.clients.filter(function(val){return val.doc_cli === num});
            if(result.length) vm.newClient = result[0]
        }

        function selectClient(cli){
            vm.newClient = cli;
        }

        function submitClient(){
            if(vm.clientsForm.$invalid) return;
            if(vm.newClient.id_cli){
                console.log("put");
                clientsFactory.putClient(vm.newClient).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }else{
                console.log("post");
                clientsFactory.postClient(vm.newClient).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function deleteClient(){
            if(!vm.newClient.id_cli) return;
            if(confirm('¿Eliminar este Cliente?')){
                clientsFactory.deleteClient(vm.newClient.id_cli).then(function(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function clearForm(){
            vm.newClient = {
                tip_doc : 'CC'
            };
        }
    }
})();