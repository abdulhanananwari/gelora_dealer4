geloraSalesShared
    .controller('SalesOrderShowRegistrationController', function(
        $state,
        SalesOrderModel) {

        var vm = this

        SalesOrderModel.get($state.params.id)
            .then(function(res) {
                vm.salesOrder = res.data.data
            })


        vm.generateStrings = function(salesOrder) {

            SalesOrderModel.polReg.generateStrings(salesOrder.id)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('String CDDB berhasil di generate')
                })
        }

        vm.updatePolReg = function(salesOrder) {

            SalesOrderModel.polReg.update(salesOrder.id, salesOrder.polReg)
                .then(function(res) {
                    vm.salesOrder = res.data.data
                    alert('Data Pol Reg berhasil diupdate')
                })
        }

        vm.calculatePaymentUnreceived = function() {

            SalesOrderModel.calculate($state.params.id)
                .then(function(res) {
                    vm.paymentUnreceived = res.data.data.payment_unreceived
                })
        }

    })
