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

            vm.salesOrder.leasingOrder.customer = _.pick(vm.salesOrder.customer, ['name', 'address', 'ktp'])
            vm.salesOrder.leasingOrder.registration = _.pick(vm.salesOrder.registration, ['name', 'address', 'ktp'])
            vm.salesOrder.leasingOrder.vehicle = vm.salesOrder.vehicle;
            vm.salesOrder.leasingOrder.on_the_road = vm.salesOrder.on_the_road
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
        vm.leasingOrder = {
            update: function(salesOrder) {
                SalesOrderModel.leasingOrder.update(salesOrder.id, salesOrder.leasingOrder)
                    .then(function(res) {
                        alert('PO berhasil di update')
                        vm.salesOrder = res.data.data
                    })
            },
            updateAfterValidation: function(salesOrder) {
                SalesOrderModel.leasingOrder.updateAfterValidation(salesOrder.id, salesOrder.leasingOrder)
                    .then(function(res) {
                        alert('PO berhasil di update')
                        vm.salesOrder = res.data.data
                    })
            },
            paymentReceivable: function(salesOrder){
                SalesOrderModel.leasingOrder.paymentReceivable(salesOrder.id, salesOrder.leasingOrder)
                    .then(function(res) {
                        vm.salesOrder = res.data.data
                    })
            }
        }
        vm.generate = {
            invoice: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-leasing-order-invoice/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            },
            agreementBPKB: function() {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-agreement-bpkb/' + vm.salesOrder.id + '?' + $.param({ jwt: JwtValidator.encodedJwt }));
            }
        }
    })
