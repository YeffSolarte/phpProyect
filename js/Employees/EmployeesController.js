(function(){
    'use strict';
    angular.module('employees')
        .controller('EmployeesController',EmployeesController);

    EmployeesController.$inject = ['$scope','employeesFactory'];

    function EmployeesController($scope,employeesFactory){
        var vm = this;
        vm.newEmployee = {
            tip_doc : 'CC'
        };
        vm.employees = [];
        vm.selectEmployee = selectEmployee;
        vm.submitEmployee = submitEmployee;
        vm.clearForm = clearForm;
        vm.getEmployeeByDocNum = getEmployeeByDocNum;
        vm.deleteEmployee = deleteEmployee;


        activate();
        function activate(){
            employeesFactory.getAllEmployees().then(function success(response){
                console.log(response);
                vm.employees = response;
            });
        }

        function getEmployeeByDocNum(num){
            if(!vm.newEmployee.doc_emp) return;
            var result = vm.employees.filter(function(val){return val.doc_emp === num});
            if(result.length) vm.newEmployee = result[0]
        }

        function selectEmployee(emp){
            vm.newEmployee = emp;
        }

        function submitEmployee(){
            if(vm.employeesForm.$invalid) return;
            if(vm.newEmployee.id_emp){
                console.log("put");
                employeesFactory.putEmployee(vm.newEmployee).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }else{
                console.log("post");
                employeesFactory.postEmployee(vm.newEmployee).then(function success(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function deleteEmployee(){
            if(!vm.newEmployee.id_emp) return;
            if(confirm('¿Eliminar este Empleado?')){
                employeesFactory.deleteEmployee(vm.newEmployee.id_emp).then(function(response){
                    console.log(response);
                    clearForm();
                    activate();
                });
            }
        }

        function clearForm(){
            vm.newEmployee = {
                tip_doc : 'CC'
            };
        }
    }
})();