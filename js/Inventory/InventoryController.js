(function(){
    'use strict';
    angular.module('inventory')
        .controller('InventoryController',InventoryController);

    InventoryController.$inject = ['$scope','inventoryFactory','itemsFactory'];

    function InventoryController($scope,inventoryFactory, itemsFactory){
        var vm = this;
        vm.newClient = {
            tip_doc : 'CC'
        };
        vm.inventory = [];
        vm.convertToInt = convertToInt;

        /*vm.selectClient = selectClient;
        vm.submitClient = submitClient;
        vm.clearForm = clearForm;
        vm.getClientByDocNum = getClientByDocNum;
        vm.deleteClient = deleteClient;*/


        activate();
        function activate(){
            itemsFactory.getAllItems().then(function success(response){
                console.log(response);
                vm.items = response;
            });
        }

        function convertToInt(num){
            return parseInt(num);
        }

        /*function getClientByDocNum(num){
            if(!vm.newClient.doc_cli) return;
            var result = vm.inventory.filter(function(val){return val.doc_cli === num});
            if(result.length) vm.newClient = result[0]
        }

        function selectClient(cli){
            vm.newClient = cli;
        }

        function submitClient(){
            if(vm.inventoryForm.$invalid) return;
            if(vm.newClient.id_cli){
                console.log("put");
                inventoryFactory.putClient(vm.newClient).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }else{
                console.log("post");
                inventoryFactory.postClient(vm.newClient).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function deleteClient(){
            if(!vm.newClient.id_cli) return;
            if(confirm('¿Eliminar este Cliente?')){
                inventoryFactory.deleteClient(vm.newClient.id_cli).then(function(response){
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
        }*/
    }
})();