(function(){
    'use strict';
    angular.module('items')
        .controller('ItemsController',ItemsController);

    ItemsController.$inject = ['$scope','itemsFactory'];

    function ItemsController($scope,itemsFactory){
        var vm = this;
        vm.newItem = {};
        vm.items = [];
        vm.selectItem = selectItem;
        vm.submitItem = submitItem;
        vm.clearForm = clearForm;
        vm.getItemByCode = getItemByCode;
        vm.deleteItem = deleteItem;


        activate();
        function activate(){
            itemsFactory.getAllItems().then(function success(response){
                console.log(response);
                vm.items = response;
            });
        }

        function getItemByCode(code){
            if(!vm.newItem.cod_art) return;
            var resultado = vm.items.filter(function(val){return val.cod_art === code});
            if(resultado.length) vm.newItem = resultado[0];
        }

        function selectItem(item){
            vm.newItem = item;
        }

        function submitItem(){
            if(vm.itemsForm.$invalid) return;
            if(vm.newItem.id_art){
                console.log("put");
                itemsFactory.putItem(vm.newItem).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }else{
                console.log("post");
               itemsFactory.postItem(vm.newItem).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function deleteItem(){
            if(!vm.newItem.id_art) return;
            if(confirm('¿Eliminar este Item?')){
                itemsFactory.deleteItem(vm.newItem.id_art).then(function(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function clearForm(){
            vm.newItem = {};
        }
    }
})();