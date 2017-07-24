geloraSalesAdmin
    .controller('SalesOrderIndexLeasingPaymentController', function(
        SalesOrderModel, SettingModel,
        JwtValidator) {

        var vm = this

        var load = function(leasingOrderFilter) {

            vm.filter = _.assignWith(vm.filter, leasingOrderFilter)

            return SalesOrderModel.index(vm.filter)
                .then(function(res) {

                    vm.salesOrders = res.data.data
                })

        }

        vm.load = {
            notCreated: function() {
                load({
                    payment_type: 'credit',
                    status: 'delivery_generated_and_not_invoiced',
                })
            },
            notSent: function() {
                load({
                    payment_type: 'credit',
                    status: 'invoice_generated_and_not_batched',
                })
            },
            notPaid: function() {
                load({
                    payment_type: 'credit',
                    status: 'invoice_batched_and_not_paid',
                })
            },
            mainReceivablePaid: function() {
                load({
                    payment_type: 'credit',
                    status: 'main_receivable_paid',
                })
            },
            fromFilter: function() {
                load({
                        payment_type: 'credit'
                    })
                    .then(function() {
                        $('#spk-filter-modal').modal('hide')
                    })
            },
        }

    })