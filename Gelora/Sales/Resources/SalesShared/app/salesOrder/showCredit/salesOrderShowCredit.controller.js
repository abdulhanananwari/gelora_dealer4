geloraSalesShared
    .controller('SalesOrderShowCreditController', function(
        $state,LinkFactory,JwtValidator,
        SalesOrderModel, ConfigModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })

        ConfigModel.get('gelora.creditSales.dueDateTypes')
            .then(function(res) {
                vm.dueDayTypes = res.data.data
            })


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
            invoice: function () {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-invoice/' + vm.salesOrder.id + '?' + $.param({jwt:JwtValidator.encodedJwt}));
            },
            agreementBPKB: function () {
                window.open(LinkFactory.dealer.sales.salesOrder.leasingOrder.views + 'generate-agreementBPKB/' + vm.salesOrder.id + '?' + $.param({jwt:JwtValidator.encodedJwt}));
            }
        }
    })
