(function(){
    'use strict';
    angular.module('purchase')
        .controller('PurchaseController',PurchaseController);

    PurchaseController.$inject = ['$scope','purchaseFactory','employeesFactory','providersFactory', 'itemsFactory'];

    function PurchaseController($scope,purchaseFactory,employeesFactory,providersFactory, itemsFactory){
        var vm = this;
        vm.newPurchase = {
            id_tip : 1,
            fec_fac : new Date(),
            tot_des: 0,
            tot_fac : 0,
            documentDetailList : []
        };
        vm.providers = [];
        vm.employees = [];
        vm.items = [];
        vm.submitPurchase= submitPurchase;
        vm.clearForm = clearForm;
        vm.addRow = addRow;
        vm.delItem = delItem;
        vm.totalingPurchaseOrders = totalingPurchaseOrders;
        //vm.getProviderByDocNum = getProviderByDocNum;
        //vm.deleteProvider = deleteProvider;

        $scope.gridOptions = {
            data : vm.newPurchase.documentDetailList,
            enableColumnMenus: false,
            enableRowSelection : true,
            enableRowHeaderSelection: false,
            enableColumnResize: true,
            multiSelect: false,
            cellTooltip: true,
            enableCellEditOnFocus : true,
            enableHorizontalScrollbar : 0,
            onRegisterApi: function (gridApi){
                $scope.gridApi = gridApi;
            }
        };

        $scope.gridOptions.columnDefs = [
            {
                field: 'cod_art',
                displayName: 'Código',
                width : '15%'
            },
            {
                field: 'nom_art',
                displayName: 'Nombre',
                 width : '40%'
            },
            {
                field: 'pre_ven',
                displayName: 'Valor',
                width : '15%'
            },
            {
                field: 'quantity',
                displayName: 'Cantidad',
                width : '15%'
            },
            {
                field: 'value',
                displayName: 'Valor'
            }
        ];

        activate();
        function activate(){
            purchaseFactory.getConsecutive(vm.newPurchase.id_tip).then(function success(response){
                vm.newPurchase.lastConsecutive = angular.copy(response.consecutivo);
                vm.newPurchase.consecutivo = (parseInt(response.consecutivo)) + 1;
                console.log(response);
                employeesFactory.getAllEmployees().then(function success(respEmp){
                    vm.employees = respEmp.length ? respEmp : [];
                    providersFactory.getAllProviders().then(function success(respPro){
                        vm.providers = respPro.length ? respPro : [];
                        itemsFactory.getAllItems().then(function success(resItems){
                            vm.items = resItems.length ? resItems : [];
                        });

                    });
                });
                //vm.providers = response;
            });
        }


        function submitPurchase(){
            if(vm.purchaseForm.$invalid) return;
            vm.newPurchase.id_cli = null;
//            vm.newPurchase.id_fac = parseInt(vm.newPurchase.id_fac);
//            vm.newPurchase.id_emp = parseInt(vm.newPurchase.id_emp);
//            vm.newPurchase.id_pro = parseInt(vm.newPurchase.id_pro);
//            vm.newPurchase.tot_des = parseFloat(vm.newPurchase.tot_des);
//            vm.newPurchase.tot_fac = parseFloat(vm.newPurchase.tot_fac);
            vm.newPurchase.documentDetailList = $scope.gridOptions.data;
            if(vm.newPurchase.id_fac){
                console.log("put");
                // purchaseFactory.putPurchase(vm.newPurchase).then(function success(response){
                //     console.log(response);
                //     clearForm();
                //     activate();
                // });
            }else{
                console.log("post");
                console.log(angular.toJson(vm.newPurchase, true));
                purchaseFactory.postPurchase(vm.newPurchase).then(function success(response){
                    console.log(response);
//                    clearForm();
//                    activate();
                });
            }
        }


        function addRow(){
            if(!vm.newPurchase.item.id_art && vm.newPurchase.item.quantity === 0) return;
            $scope.gridApi.grid.cellNav.clearFocus();
            var x = $scope.gridOptions.data.length,
                val = $scope.gridOptions.data[x - 1];
            if (x > 0) {
                if (!val.id_art){
                    $scope.gridApi.cellNav.scrollToFocus($scope.gridOptions.data[$scope.gridOptions.data.length-1],$scope.gridOptions.columnDefs[0]);
                }
                else
                    okAddRow();
            }else{
                okAddRow();
            }
        }

        function okAddRow (){
            var i = vm.newPurchase.item;
            i.quantity = vm.newPurchase.quantity;
            i.value = (parseInt(i.pre_ven)) * i.quantity;
            $scope.gridOptions.data.push(i);
            vm.newPurchase.item = '';
            vm.newPurchase.quantity = 0;
            totalingPurchaseOrders();
        }

        function delItem(ev){
            var rowCol = $scope.gridApi.cellNav.getFocusedCell(), indexSelected = '';
            console.log(rowCol);
            if(!rowCol) return;
            if(!$scope.gridOptions.data.some(function (val){return val === rowCol.row.entity;}))return;
            indexSelected = $scope.gridOptions.data.indexOf(rowCol.row.entity);
            if(indexSelected !== null && indexSelected !== undefined){
                if(confirm("¿Desea eliminar ste Item?")){
                    $scope.gridOptions.data.splice(indexSelected,1);
                    totalingPurchaseOrders();
                }
            }
        }

        function totalingPurchaseOrders(){
            var value = 0;
            if(!$scope.gridOptions.data.length) return;
            $scope.gridOptions.data.forEach(function(val){
                value += val.value;
            });
            if(vm.newPurchase.tot_des){
                value = (value * vm.newPurchase.tot_des) / 100;
            }else{
                vm.newPurchase.tot_fac = value;
            }

        }

        function getProviderByDocNum(num){
            if(!vm.newPurchase.doc_pro) return;
            var result = vm.providers.filter(function(val){return val.doc_pro === num});
            if(result.length) vm.newPurchase = result[0]
        }



        /*function deleteProvider(){
            if(!vm.newPurchase.id_fac) return;
            if(confirm('�Eliminar este Proveedor?')){
                purchaseFactory.deletePurchase(vm.newPurchase.id_fac).then(function(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }*/

        function clearForm(){
            vm.newPurchase = {
                tip_doc : 'CC',
                id_tip : 1,
                fec_fac : new Date(),
                tot_des: 0,
                tot_fac : 0,
                documentDetailList : []
            };
            totalingPurchaseOrders();
        }
    }
})();