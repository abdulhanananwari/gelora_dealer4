geloraSalesShared
    .controller('SalesOrderShowCreditController', function(
        $state,
        LinkFactory, JwtValidator, ConfigModel, AppFactory,
        SalesOrderModel) {

        var vm = this

        vm.appType = AppFactory.type

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })

        ConfigModel.get('gelora.creditSales.dueDateTypes')
            .then(function(res) {
                vm.dueDayTypes = res.data.data
            })

        vm.copyLeasingOrderFromSalesOrder = function() {
            vm.salesOrder.leasingOrder.customer = angular.copy(vm.salesOrder.customer);
            vm.salesOrder.leasingOrder.registration =angular.copy(vm.salesOrder.registration);
            vm.salesOrder.leasingOrder.vehicle = angular.copy(vm.salesOrder.vehicle);
        }

        vm.store = function(salesOrder) {
            SalesOrderModel.leasingOrder.update(salesOrder.id, salesOrder.leasingOrder)
                .then(function(res) {
                    alert('Update berhasil')
                    vm.salesOrder = res.data.data
                })
        }

        vm.assignFromLeasingOrder = function(leasingOrderId) {

            SalesOrderModel.leasingOrder.assignFromLeasingOrder(vm.salesOrder.id, leasingOrderId)
                .then(function(res) {
                    alert('Berhasil menyambungkan PO ' + leasingOrderId)
                    vm.salesOrder = res.data.data
                })
        }
        vm.generate = {
            invoice: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-invoice/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
            agreementBPKB: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-agreementBPKB/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            }
        }
    })
