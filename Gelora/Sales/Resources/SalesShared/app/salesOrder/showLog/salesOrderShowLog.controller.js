geloraSalesShared
    .controller('SalesOrderShowLogController', function(
        $state) {

        var vm = this

        vm.salesOrderId = $state.params.id
    })
