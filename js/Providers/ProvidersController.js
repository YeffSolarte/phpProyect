(function(){
    'use strict';
    angular.module('providers')
        .controller('ProviderController',ProviderController);

    ProviderController.$inject = ['$scope','providersFactory'];

    function ProviderController($scope,providersFactory){
        var vm = this;
        vm.newProvider = {
            tip_doc : 'CC'
        };
        vm.providers = [];
        vm.selectProvider = selectProvider;
        vm.submitProvider = submitProvider;
        vm.clearForm = clearForm;
        vm.getProviderByDocNum = getProviderByDocNum;
        vm.deleteProvider = deleteProvider;


        activate();
        function activate(){
            providersFactory.getAllProviders().then(function success(response){
                console.log(response);
                vm.providers = response;
            });
        }

        function getProviderByDocNum(num){
            if(!vm.newProvider.doc_pro) return;
            var result = vm.providers.filter(function(val){return val.doc_pro === num});
            if(result.length) vm.newProvider = result[0]
        }

        function selectProvider(pro){
            vm.newProvider = pro;
        }

        function submitProvider(){
            if(vm.providersForm.$invalid) return;
            if(vm.newProvider.id_pro){
                console.log("put");
                providersFactory.putProvider(vm.newProvider).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }else{
                console.log("post");
                providersFactory.postProvider(vm.newProvider).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function deleteProvider(){
            if(!vm.newProvider.id_pro) return;
            if(confirm('¿Eliminar este Proveedor?')){
                providersFactory.deleteProvider(vm.newProvider.id_pro).then(function(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function clearForm(){
            vm.newProvider = {
                tip_doc : 'CC'
            };
        }
    }
})();