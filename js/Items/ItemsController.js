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


        activate();
        function activate(){
            itemsFactory.getAllItems().then(function success(response){
                console.log(response);
                vm.items = response;
            });
        }

        function getItemByCode(code){
            if(!vm.newItem.cod_art) return;
            vm.newItem = vm.items.filter(function(val){return val.cod_art === code})[0];
        }

        function selectItem(item){
            vm.newItem = item;
        }

        function submitItem(){
            if(vm.itemsForm.$invalid) return;
            if(vm.newItem.id_art){
                
            }else{

            }
        }

        function clearForm(){
            vm.newItem = {};
        }
    }
})();